<?php

namespace App\Models;

use CodeIgniter\Model;

class Client extends Model
{
    protected $table            = 'client';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nom',
        'numero'
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


    public function findByNumero(string $numero)
    {
        return $this->where('numero', $numero)->first();
    }

    public function inscrire(string $nom, string $numero)
    {
        return $this->insert(['nom' => $nom, 'numero' => $numero]);
    }
    
        public function getSolde($idClient) {
        $db = \Config\Database::connect();

        $result = $db->table('mouvement')
            ->select('SUM(CASE WHEN sens = "CREDIT" THEN montant ELSE -montant END) as solde')
            ->where('id_client', $idClient)
            ->get()
            ->getRowArray();
        return (float) $result['solde'] ?? 0.0;
    }

    public function getByNumero($numero) {
        return $this->where('numero', $numero)->first();
    }

    public function getOperateur($numero) {
        $prefixe = substr($numero, 0, 3);

        return db_connect()
            ->table('prefixe')
            ->where('prefixe', $prefixe)
            ->get()
            ->getRowArray();
    }

    public function memeOperateur($num1, $num2) {
        $op1 = $this->getOperateur($num1);
        $op2 = $this->getOperateur($num2);

        if (!$op1 || !$op2) {
            return false;
        }

        return $op1['id_operateur'] === $op2['id_operateur'];
    }
}
