<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientModel extends Model
{
    protected $table = 'client';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nom', 'numero'];
    protected $returnType = 'object';

    public function findByNumero(string $numero)
    {
        return $this->where('numero', $numero)->first();
    }

    public function inscrire(string $nom, string $numero)
    {
        return $this->insert(['nom' => $nom, 'numero' => $numero]);
    }
}
