<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PrefixeModel;
use App\Models\Operateur;

class PrefixeController extends BaseController
{
    public function index()
    {
        $prefixeModel  = new PrefixeModel();
        $operateurModel = new Operateur();

        $id_operateur = $this->request->getGet('id_operateur');
        $prefixes     = $prefixeModel->filtrer($id_operateur);
        $operateurs   = $operateurModel->findAll();

        return view('prefixe/index', [
            'prefixes'   => $prefixes,
            'operateurs' => $operateurs,
            'filters'    => ['id_operateur' => $id_operateur ?? ''],
        ]);
    }

    public function create()
    {
        $model = new Operateur();
        $operateurs = $model->findAll();

        return view('prefixe/create', ['operateurs' => $operateurs]);
    }

    public function store()
    {
        $model = new PrefixeModel();
        $model->insert([
            'prefixe'       => $this->request->getPost('prefixe'),
            'id_operateur'  => $this->request->getPost('id_operateur'),
        ]);

        return redirect()->to('/prefixe');
    }

    public function edit($id)
    {
        $prefixeModel   = new PrefixeModel();
        $operateurModel = new Operateur();

        $prefixe    = $prefixeModel->find($id);
        $operateurs = $operateurModel->findAll();

        return view('prefixe/edit', [
            'prefixe'     => $prefixe,
            'operateurs'  => $operateurs,
        ]);
    }

    public function update($id)
    {
        $model = new PrefixeModel();
        $model->update($id, [
            'prefixe'       => $this->request->getPost('prefixe'),
            'id_operateur'  => $this->request->getPost('id_operateur'),
        ]);

        return redirect()->to('/prefixe');
    }

    public function delete($id)
    {
        $model = new PrefixeModel();
        $model->delete($id);

        return redirect()->to('/prefixe');
    }
}
