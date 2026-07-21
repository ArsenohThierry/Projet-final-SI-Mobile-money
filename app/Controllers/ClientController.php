<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Client;
use App\Models\Transaction;
use App\Models\PrefixeModel;

class ClientController extends BaseController
{
    public function index()
    {
        $model   = new Client();
        $clients = $model->findAll();

        return view('client/index', ['clients' => $clients]);
    }

    public function detail($id)
    {
        $clientModel   = new Client();
        $transacModel  = new Transaction();

        $client      = $clientModel->find($id);
        $solde       = $clientModel->getSolde($id);
        $historique  = $transacModel->historique($id);

        return view('client/detail', [
            'client'     => $client,
            'solde'      => $solde,
            'historique' => $historique,
        ]);
    }

    public function create()
    {
        return view('client/create');
    }

    public function store()
    {
        $model = new Client();
        $model->insert([
            'nom'    => $this->request->getPost('nom'),
            'numero' => $this->request->getPost('numero'),
        ]);

        return redirect()->to('/client');
    }

    public function edit($id)
    {
        $model  = new Client();
        $client = $model->find($id);

        return view('client/edit', ['client' => $client]);
    }

    public function update($id)
    {
        $model = new Client();
        $model->update($id, [
            'nom'    => $this->request->getPost('nom'),
            'numero' => $this->request->getPost('numero'),
        ]);

        return redirect()->to('/client');
    }

    public function delete($id)
    {
        $model = new Client();
        $model->delete($id);

        return redirect()->to('/client');
    }

    public function loginClient()
    {
        $numero = $this->request->getPost('numero');

        $prefixeModel = new PrefixeModel();
        if (!$prefixeModel->estValide($numero)) {
            return redirect()->to('/auth/login-client')->with('error', 'Numero non Valide');
        }

        $model = new Client();
        $client = $model->findByNumero($numero);

        if ($client) {
            $session = session();
            $session->set([
                'id_client'   => $client['id'],
                'nom_client'  => $client['nom'],
                'logged_in'   => true,
            ]);

            return redirect()->to('/dashboard');
        }

        return redirect()->to('/auth/inscription-client?numero=' . $numero);
    }

    public function dashboard()
    {
    echo session()->get('nom_client');
    die();
        return view('client/dashboard');
    }

    public function inscription()
    {
        $nom    = $this->request->getPost('nom');
        $numero = $this->request->getPost('numero');

        $prefixeModel = new PrefixeModel();
        if (!$prefixeModel->estValide($numero)) {
            return redirect()->to('/auth/inscription-client?numero=' . $numero)->with('error', 'Numero non Valide');
        }

        $model = new Client();
        $model->inscrire($nom, $numero);

        $client = $model->findByNumero($numero);

        $session = session();
        $session->set([
            'id_client'  => $client->id,
            'nom_client' => $client->nom,
            'logged_in'  => true,
        ]);

        return redirect()->to('/dashboard');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
