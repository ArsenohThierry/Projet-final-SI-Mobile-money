<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Operateur;

class OperateurController extends BaseController
{
    public function index()
    {
        $model = new Operateur();
        $operateurs = $model->findAll();

        return view('operateur_crud/index', ['operateurs' => $operateurs]);
    }

    public function create()
    {
        return view('operateur_crud/create');
    }

    public function store()
    {
        $model = new Operateur();
        $model->insert([
            'nom'            => $this->request->getPost('nom'),
            'pct_comission'  => $this->request->getPost('pct_comission'),
        ]);

        return redirect()->to('/operateur-crud');
    }

    public function edit($id)
    {
        $model = new Operateur();
        $operateur = $model->find($id);

        return view('operateur_crud/edit', ['operateur' => $operateur]);
    }

    public function update($id)
    {
        $model = new Operateur();
        $model->update($id, [
            'nom'            => $this->request->getPost('nom'),
            'pct_comission'  => $this->request->getPost('pct_comission'),
        ]);

        return redirect()->to('/operateur-crud');
    }

    public function delete($id)
    {
        $model = new Operateur();
        $model->delete($id);

        return redirect()->to('/operateur-crud');
    }
}
