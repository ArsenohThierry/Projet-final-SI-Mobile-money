<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Operateur;
use App\Models\UserOperateurModel;
use App\Models\GainModel;

class OperateurController extends BaseController
{

    public function index()
    {
        $model = new Operateur();
        $operateurs = $model->findAll();

        return view('operateur_crud/index', ['operateurs' => $operateurs]);
    }

        public function dashboard()
    {
        $model = new GainModel();
        $totalGains = $model->totalGains();

        $totalGainsAutresOperateurs = $model->totalGainsAutresOperateurs();

        return view('operateur/dashboard', ['totalGains' => $totalGains, 'totalGainsAutresOperateurs' => $totalGainsAutresOperateurs]);
    }

    public function montantsAEnvoyer()
    {
        $operateurModel = new Operateur();

        $idOperateur = $this->request->getGet('id_operateur');
        $resume = $operateurModel->montantsAEnvoyer();
        $details = $operateurModel->detailMontantsAEnvoyer($idOperateur);
        $operateurs = $operateurModel->findAll();

        return view('operateur/montants_a_envoyer', [
            'resume'     => $resume,
            'details'    => $details,
            'operateurs' => $operateurs,
            'filters'    => ['id_operateur' => $idOperateur ?? ''],
        ]);
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
        $model = new UserOperateurModel();
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
