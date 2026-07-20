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

    public function transfert($expediteur, $destinataire, $montant) {
        $client = new Client();
        $bareme = new BaremeFrais();
        $mouvement = new Mouvement();

        $frais = $bareme->calculerFrais(3, $montant);

        $total = $montant + $frais;

        if ($client->getSolde($expediteur) < $total) {
            return false;
        }

        $db = db_connect();
        $db->transStart();

        $idTranscation = $this->insert([
            'id_type_operation' => 3,
            'montant' => $montant
        ]);

        $mouvement->debit(
            $idTranscation,
            $expediteur,
            $total
        );

        $mouvement->credit(
            $idTranscation,
            $destinataire,
            $montant
        );

        $db->table('gain')->insert([
            'id_transaction' => $idTranscation,
            'montant' => $frais
        ]);

        $db->transComplete();

        return $db->transStatus();
    }

    public function historique($idClient)
    {
        return $this
            ->select('
                transaction_mm.*,
                type_operation.libelle,
                mouvement.sens,
                mouvement.montant montant_mouvement
            ')
            ->join(
                'mouvement',
                'mouvement.id_transaction = transaction_mm.id'
            )
            ->join(
                'type_operation',
                'type_operation.id = transaction_mm.id_type_operation'
            )
            ->where('mouvement.id_client',$idClient)
            ->orderBy('date_transaction','DESC')
            ->findAll();
    }

}