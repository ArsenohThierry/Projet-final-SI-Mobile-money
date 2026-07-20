<?php

namespace App\Models;

use CodeIgniter\Model;

class Mouvement extends Model
{
    protected $table            = 'mouvement';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_transaction',
        'id_client',
        'numero',
        'sens',
        'montant',
        'frais'
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

    public function ajouter($idTransaction, $idClient, $sens, $montant) {
        return $this->insert([
            'id_transaction' => $idTransaction,
            'id_client'      => $idClient,
            'sens'           => $sens,
            'montant'        => $montant
        ]);
    }
    public function credit($idTransaction,$idClient,$montant, $frais = 0)
    {
        return $this->insert([
            'id_transaction'=>$idTransaction,
            'id_client'=>$idClient,
            'sens'=>'CREDIT',
            'montant'=>$montant,
            'frais'=>$frais
        ]);
    }

    public function debit($idTransaction,$idClient,$montant, $frais = 0)
    {
        return $this->insert([
            'id_transaction'=>$idTransaction,
            'id_client'=>$idClient,
            'sens'=>'DEBIT',
            'montant'=>$montant,
            'frais'=>$frais
        ]);
    }

    public function creditParNumero($idTransaction, $numero, $montant)
    {
        return $this->insert([
            'id_transaction' => $idTransaction,
            'numero'         => $numero,
            'sens'           => 'CREDIT',
            'montant'        => $montant
        ]);
    }
}
