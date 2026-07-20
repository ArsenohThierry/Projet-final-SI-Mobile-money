<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OperateurModel;
use App\Models\GainModel;
use CodeIgniter\HTTP\ResponseInterface;

class OperateurControlleur extends BaseController
{
    public function dashboard()
    {
        $model = new GainModel();
        $totalGains = $model->totalGains();

        return view('operateur/dashboard', ['totalGains' => $totalGains]);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    public function loginOperateur()
    {
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $model = new OperateurModel();
        $operateur = $model->verifierLogin($email, $password);

        if ($operateur) {
            $session = session();
            $session->set([
                'id_operateur'  => $operateur->id,
                'nom_operateur' => $operateur->nom,
                'logged_in'     => true,
            ]);

            return redirect()->to('/operateur/dashboard');
        }

        return redirect()->to('/auth/login-operateur')->with('error', 'Email ou mot de passe incorrect');
    }
}
