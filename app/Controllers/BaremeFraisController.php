<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BaremeFraisModel;
use App\Models\TypeOperationModel;

class BaremeFraisController extends BaseController
{
    public function index()
    {
        $model   = new BaremeFraisModel();
        $typesOp = new TypeOperationModel();

        $builder = $model->builder();
        $builder->select('bareme_frais.*, type_operation.libelle AS type_libelle');
        $builder->join('type_operation', 'type_operation.id = bareme_frais.id_type_operation');

        $id_type_operation = $this->request->getGet('id_type_operation');
        $montant_min       = $this->request->getGet('montant_min');
        $montant_max       = $this->request->getGet('montant_max');
        $frais_min         = $this->request->getGet('frais_min');
        $frais_max         = $this->request->getGet('frais_max');
        $frais_exact       = $this->request->getGet('frais_exact');

        if ($id_type_operation !== null && $id_type_operation !== '') {
            $builder->where('bareme_frais.id_type_operation', $id_type_operation);
        }
        if ($montant_min !== null && $montant_min !== '') {
            $builder->where('bareme_frais.montant_min >=', $montant_min);
        }
        if ($montant_max !== null && $montant_max !== '') {
            $builder->where('bareme_frais.montant_max <=', $montant_max);
        }
        if ($frais_exact !== null && $frais_exact !== '') {
            $builder->where('bareme_frais.frais', $frais_exact);
        } else {
            if ($frais_min !== null && $frais_min !== '') {
                $builder->where('bareme_frais.frais >=', $frais_min);
            }
            if ($frais_max !== null && $frais_max !== '') {
                $builder->where('bareme_frais.frais <=', $frais_max);
            }
        }

        $frais = $builder->get()->getResult();
        $types = $typesOp->findAll();

        $filters = [
            'id_type_operation' => $id_type_operation ?? '',
            'montant_min'       => $montant_min ?? '',
            'montant_max'       => $montant_max ?? '',
            'frais_min'         => $frais_min ?? '',
            'frais_max'         => $frais_max ?? '',
            'frais_exact'       => $frais_exact ?? '',
        ];

        return view('bareme_frais/index', ['frais' => $frais, 'types' => $types, 'filters' => $filters]);
    }

    public function create()
    {
        $model = new TypeOperationModel();
        $types = $model->findAll();

        return view('bareme_frais/create', ['types' => $types]);
    }

    public function store()
    {
        $model = new BaremeFraisModel();
        $model->insert([
            'id_type_operation' => $this->request->getPost('id_type_operation'),
            'montant_min'       => $this->request->getPost('montant_min'),
            'montant_max'       => $this->request->getPost('montant_max'),
            'frais'             => $this->request->getPost('frais'),
        ]);

        return redirect()->to('/bareme-frais');
    }

    public function edit($id)
    {
        $model  = new BaremeFraisModel();
        $typesM = new TypeOperationModel();

        $frais = $model->find($id);
        $types = $typesM->findAll();

        return view('bareme_frais/edit', ['frais' => $frais, 'types' => $types]);
    }

    public function update($id)
    {
        $model = new BaremeFraisModel();
        $model->update($id, [
            'id_type_operation' => $this->request->getPost('id_type_operation'),
            'montant_min'       => $this->request->getPost('montant_min'),
            'montant_max'       => $this->request->getPost('montant_max'),
            'frais'             => $this->request->getPost('frais'),
        ]);

        return redirect()->to('/bareme-frais');
    }

    public function delete($id)
    {
        $model = new BaremeFraisModel();
        $model->delete($id);

        return redirect()->to('/bareme-frais');
    }
}
