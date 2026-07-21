<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\Mouvement;
use App\Models\Client;
use App\Models\BaremeFrais;

class Transaction extends Model
{
    protected $table            = 'transaction_mm';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_type_operation',
        'montant'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function depot($idClient,$montant)
    {
        $db = db_connect();

        $db->transStart();

        $this->insert([
            'id_type_operation'=>1,
            'montant'=>$montant
        ]);

        $idTransaction = $this->insertID();

        $mouvement = new Mouvement();

        $mouvement->credit(
            $idTransaction,
            $idClient,
            $montant
        );

        $db->transComplete();

        return $db->transStatus();
    }


    public function retrait($idClient,$montant)
    {
        $client = new Client();
        $bareme = new BaremeFrais();
        $mouvement = new Mouvement();

        $frais = $bareme->calculerFrais(2,$montant);

        $total = $montant + $frais;

        if($client->getSolde($idClient) < $total)
            return false;

        $db = db_connect();

        $db->transStart();

        $idTransaction = $this->insert([
            'id_type_operation'=>2,
            'montant'=>$montant
        ]);

        $mouvement->debit(
            $idTransaction,
            $idClient,
            $total
        );

        $db->table('gain')->insert([
            'id_transaction'=>$idTransaction,
            'montant'=>$frais
        ]);

        $db->transComplete();

        return $db->transStatus();
    }

    // public function transfert($expediteur, $destinataire, $montant) {
    //     $client = new Client();
    //     $bareme = new BaremeFrais();
    //     $mouvement = new Mouvement();

    //     $frais = $bareme->calculerFrais(3, $montant);

    //     $total = $montant + $frais;

    //     if ($client->getSolde($expediteur) < $total) {
    //         return false;
    //     }

    //     $db = db_connect();
    //     $db->transStart();

    //     $idTranscation = $this->insert([
    //         'id_type_operation' => 3,
    //         'montant' => $montant
    //     ]);

    //     $mouvement->debit(
    //         $idTranscation,
    //         $expediteur,
    //         $total
    //     );

    //     $mouvement->credit(
    //         $idTranscation,
    //         $destinataire,
    //         $montant
    //     );

    //     $db->table('gain')->insert([
    //         'id_transaction' => $idTranscation,
    //         'montant' => $frais
    //     ]);

    //     $db->transComplete();

    //     return $db->transStatus();
    // }

    public function transfert(int $idExpediteur, array $idDestinataires, float $montant, bool $priseEnChargeRetrait = false) {
        $client = new Client();
        $bareme = new BaremeFrais();
        $mouvement = new Mouvement();

        if (count($idDestinataires) == 0) {
            return false;
        }

        $numeroExpediteur = $client->find($idExpediteur)['numero'];

        foreach ($idDestinataires as $idDestinataire) {

            $dest = $client->find($idDestinataire);

            if (!$dest) {
                return false;
            }

            $memeOperateur = $client->memeOperateur(
                $numeroExpediteur,
                $dest['numero']
            );

            // transfert multiple autorisé qu'entre clients du même opérateur
            $transfertMultiple = count($idDestinataires) > 1;
            if($transfertMultiple && !$memeOperateur) {
                return false;
            }

            // impossible de prendre en charge les frais si opérateurs différents
            if ($priseEnChargeRetrait && !$memeOperateur) {
                return false;
            }
        }

        $nbDestinataires = count($idDestinataires);
        $part = $montant / $nbDestinataires;

        $fraisTransfert = $bareme->calculerFrais(3, $montant);

        $fraisRetrait = 0;

        if ($priseEnChargeRetrait) {
            $fraisRetrait = $bareme->calculerFrais(2, $part);
        }

        $totalDebit = $montant + $fraisTransfert + ($fraisRetrait * $nbDestinataires);

        if ($client->getSolde($idExpediteur) < $totalDebit) {
            return false;
        }

        $db = db_connect();
        $db->transStart();

        $this->insert([
            'id_type_operation' => 3,
            'montant' => $montant
        ]);

        $idTransaction = $this->insertID();

        $mouvement->debit(
            $idTransaction,
            $idExpediteur,
            $totalDebit,
            $fraisTransfert
        );

        foreach ($idDestinataires as $idDestinataire) {

            $mouvement->credit(
                $idTransaction,
                $idDestinataire,
                $part,
                $priseEnChargeRetrait ? $fraisRetrait : 0
            );
        }

        $db->table('gain')->insert([
            'id_transaction' => $idTransaction,
            'montant' => $fraisTransfert
        ]);

        $db->transComplete();

        return $db->transStatus();
    }

    public function transfertAutreOperateur($expediteur, $numeroDestinataire, $montant) {
        $client = new Client();
        $bareme = new BaremeFrais();
        $mouvement = new Mouvement();
        $prefixeModel = new PrefixeModel();
        $operateurModel = new Operateur();

        $frais = $bareme->calculerFrais(3, $montant);

        $idOperateurDest = $prefixeModel->getOperateurByNumero($numeroDestinataire);
        $operateur = $operateurModel->find($idOperateurDest);
        $pctCommission = $operateur->pct_comission;
        $commission = $montant * ($pctCommission / 100);

        $total = $montant + $frais + $commission;

        if ($client->getSolde($expediteur) < $total) {
            return false;
        }

        $db = db_connect();
        $db->transStart();

        $idTransaction = $this->insert([
            'id_type_operation' => 3,
            'montant' => $montant
        ]);

        $mouvement->debit($idTransaction, $expediteur, $total);

        $mouvement->creditParNumero($idTransaction, $numeroDestinataire, $montant);

        $db->table('gain')->insert([
            'id_transaction' => $idTransaction,
            'montant' => $frais
        ]);

        $db->transComplete();

        return $db->transStatus();
    }

    public function historique($idClient)
    {
        $db = db_connect();
        return $db->table('mouvement m')
            ->select('
                t.date_transaction,
                t.montant montant_transaction,
                ty.libelle,
                m.sens,
                m.montant montant_mouvement,
                cm.numero numero_counterpart,
                cm.sens sens_counterpart,
                cc.numero numero_counterpart_client,
                cc.nom nom_counterpart_client,
                o.pct_comission
            ')
            ->join('transaction_mm t', 't.id = m.id_transaction')
            ->join('type_operation ty', 'ty.id = t.id_type_operation')
            ->join('mouvement cm', 'cm.id_transaction = m.id_transaction AND cm.id != m.id','left')
            ->join('client cc', 'cc.id = cm.id_client', 'left')
            ->join('prefixe pf', 'SUBSTR(cm.numero, 1, 3) = pf.prefixe', 'left')
            ->join('operateur o', 'o.id = pf.id_operateur', 'left')
            ->where('m.id_client', $idClient)
            ->orderBy('t.date_transaction', 'DESC')
            ->get()
            ->getResultArray();
    }

}