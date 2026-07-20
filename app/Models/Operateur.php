<?php

namespace App\Models;

use CodeIgniter\Model;

class Operateur extends Model
{
    protected $table = 'operateur';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nom', 'pct_comission'];
    protected $returnType = 'object';

    public function montantsAEnvoyer()
    {
        $db = db_connect();
        return $db->table('mouvement m')
            ->select('
                o.id as operateur_id,
                o.nom as operateur_nom,
                SUM(m.montant) as total_montant,
                SUM(m.montant * (o.pct_comission / 100)) as total_commission,
                SUM(m.montant + m.montant * (o.pct_comission / 100)) as total_a_envoyer
            ')
            ->join('prefixe p', 'SUBSTR(m.numero, 1, 3) = p.prefixe')
            ->join('operateur o', 'p.id_operateur = o.id')
            ->where('m.numero IS NOT NULL')
            ->where('m.id_client IS NULL')
            ->where('m.sens', 'CREDIT')
            ->groupBy('o.id, o.nom')
            ->get()
            ->getResult();
    }

    public function detailMontantsAEnvoyer($idOperateur = null)
    {
        $db = db_connect();
        $builder = $db->table('mouvement m')
            ->select('
                m.numero,
                m.montant,
                m.montant * (o.pct_comission / 100) as commission,
                m.montant + m.montant * (o.pct_comission / 100) as total_a_envoyer,
                o.nom as operateur_nom,
                t.date_transaction
            ')
            ->join('transaction_mm t', 't.id = m.id_transaction')
            ->join('prefixe p', 'SUBSTR(m.numero, 1, 3) = p.prefixe')
            ->join('operateur o', 'p.id_operateur = o.id')
            ->where('m.numero IS NOT NULL')
            ->where('m.id_client IS NULL')
            ->where('m.sens', 'CREDIT');

        if ($idOperateur !== null && $idOperateur !== '') {
            $builder->where('o.id', $idOperateur);
        }

        return $builder->orderBy('t.date_transaction', 'DESC')->get()->getResult();
    }
}
