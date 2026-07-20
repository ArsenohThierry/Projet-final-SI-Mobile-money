<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TypeOperationModel;

class TypeOperationController extends BaseController
{
    public function index()
    {
        $model = new TypeOperationModel();
        $types = $model->findAll();

        return view('type_operation/index', ['types' => $types]);
    }

    public function create()
    {
        return view('type_operation/create');
    }

    public function store()
    {
        $model = new TypeOperationModel();
        $model->insert(['libelle' => $this->request->getPost('libelle')]);

        return redirect()->to('/type-operation');
    }

    public function edit($id)
    {
        $model = new TypeOperationModel();
        $type = $model->find($id);

        return view('type_operation/edit', ['type' => $type]);
    }

    public function update($id)
    {
        $model  = new TypeOperationModel();
        $newId  = (int) $this->request->getPost('id');
        $libelle = $this->request->getPost('libelle');

        if ($newId != $id) {
            $db = $model->db();
            $db->table('type_operation')
               ->where('id', $id)
               ->update(['id' => $newId, 'libelle' => $libelle]);
        } else {
            $model->update($id, ['libelle' => $libelle]);
        }

        return redirect()->to('/type-operation');
    }

    public function delete($id)
    {
        $model = new TypeOperationModel();
        $model->delete($id);

        return redirect()->to('/type-operation');
    }
}
