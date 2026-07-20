<?php

namespace App\Models;

use CodeIgniter\Model;

class PrefixeModel extends Model
{
    protected $table = 'prefixe';
    protected $primaryKey = 'id';
    protected $allowedFields = ['prefixe', 'id_operateur'];
    protected $returnType = 'object';

    public function estValide(string $numero): bool
    {
        return $this->where('prefixe', substr($numero, 0, 3))->countAllResults() > 0;
    }

    public function existe(string $numero): bool
    {
        return $this->where('prefixe', substr($numero, 0, 3))->countAllResults() > 0;
    }

    public function getOperateurByNumero(string $numero): ?int
    {
        $prefixe = $this->where('prefixe', substr($numero, 0, 3))->first();
        return $prefixe ? (int) $prefixe->id_operateur : null;
    }

    public function avecOperateur()
    {
        return $this->select('prefixe.*, operateur.nom AS operateur_nom, operateur.pct_comission')
                     ->join('operateur', 'operateur.id = prefixe.id_operateur')
                     ->findAll();
    }

    public function filtrer($id_operateur = null)
    {
        $builder = $this->builder();
        $builder->select('prefixe.*, operateur.nom AS operateur_nom, operateur.pct_comission');
        $builder->join('operateur', 'operateur.id = prefixe.id_operateur');

        if ($id_operateur !== null && $id_operateur !== '') {
            $builder->where('prefixe.id_operateur', $id_operateur);
        }

        return $builder->get()->getResult();
    }
}
