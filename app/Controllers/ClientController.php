<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClientModel;

class ClientController extends BaseController
{
    public function index()
    {
        $model   = new ClientModel();
        $clients = $model->findAll();

        return view('client/index', ['clients' => $clients]);
    }

    public function create()
    {
        return view('client/create');
    }

    public function store()
    {
        $model = new ClientModel();
        $model->insert([
            'nom'    => $this->request->getPost('nom'),
            'numero' => $this->request->getPost('numero'),
        ]);

        return redirect()->to('/client');
    }

    public function edit($id)
    {
        $model  = new ClientModel();
        $client = $model->find($id);

        return view('client/edit', ['client' => $client]);
    }

    public function update($id)
    {
        $model = new ClientModel();
        $model->update($id, [
            'nom'    => $this->request->getPost('nom'),
            'numero' => $this->request->getPost('numero'),
        ]);

        return redirect()->to('/client');
    }

    public function delete($id)
    {
        $model = new ClientModel();
        $model->delete($id);

        return redirect()->to('/client');
    }
}
