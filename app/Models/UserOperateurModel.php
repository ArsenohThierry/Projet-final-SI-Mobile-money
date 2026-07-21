<?php

namespace App\Models;

use CodeIgniter\Model;

class UserOperateurModel extends Model
{
    protected $table = 'user_operateur';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nom', 'email', 'password'];
    protected $returnType = 'object';

    public function verifierLogin(string $email, string $password)
    {
        return $this->where('email', $email)
                     ->where('password', $password)
                     ->first();
    }
}
