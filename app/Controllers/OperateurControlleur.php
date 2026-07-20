<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OperateurModel;
use CodeIgniter\HTTP\ResponseInterface;

class OperateurControlleur extends BaseController
{
    public function dashboard()
    {
        return view('operateur/dashboard');
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
