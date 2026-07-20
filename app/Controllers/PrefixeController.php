<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PrefixeModel;

class PrefixeController extends BaseController
{
    public function index()
    {
        $model = new PrefixeModel();
        $prefixes = $model->findAll();

        return view('prefixe/index', ['prefixes' => $prefixes]);
    }

    public function create()
    {
        return view('prefixe/create');
    }

    public function store()
    {
        $model = new PrefixeModel();
        $model->insert(['prefixe' => $this->request->getPost('prefixe')]);

        return redirect()->to('/prefixe');
    }

    public function edit($id)
    {
        $model = new PrefixeModel();
        $prefixe = $model->find($id);

        return view('prefixe/edit', ['prefixe' => $prefixe]);
    }

    public function update($id)
    {
        $model = new PrefixeModel();
        $model->update($id, ['prefixe' => $this->request->getPost('prefixe')]);

        return redirect()->to('/prefixe');
    }

    public function delete($id)
    {
        $model = new PrefixeModel();
        $model->delete($id);

        return redirect()->to('/prefixe');
    }
}
