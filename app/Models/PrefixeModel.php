<?php

namespace App\Models;

use CodeIgniter\Model;

class PrefixeModel extends Model
{
    protected $table = 'prefixe';
    protected $primaryKey = 'id';
    protected $allowedFields = ['prefixe'];
    protected $returnType = 'object';

    public function estValide(string $numero): bool
    {
        $prefixes = $this->findAll();

        foreach ($prefixes as $p) {
            if (str_starts_with($numero, $p->prefixe)) {
                return true;
            }
        }

        return false;
    }
}
