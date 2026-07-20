<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClientModel;
use App\Models\PrefixeModel;

class ClientControlleur extends BaseController
{
    public function loginClient()
    {
        $numero = $this->request->getPost('numero');

        $prefixeModel = new PrefixeModel();
        if (!$prefixeModel->estValide($numero)) {
            return redirect()->to('/auth/login-client')->with('error', 'Numero non Valide');
        }

        $model = new ClientModel();
        $client = $model->findByNumero($numero);

        if ($client) {
            $session = session();
            $session->set([
                'id_client'   => $client->id,
                'nom_client'  => $client->nom,
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

        $model = new ClientModel();
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
