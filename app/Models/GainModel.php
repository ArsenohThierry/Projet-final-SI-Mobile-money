<?php

namespace App\Models;

use CodeIgniter\Model;

class GainModel extends Model
{
    protected $table = 'gain';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_transaction', 'montant'];
    protected $returnType = 'object';

    public function totalGains()
    {
        $result = $this->select('SUM(montant) as total')->first();
        return (float) ($result->total ?? 0);
    }
}
