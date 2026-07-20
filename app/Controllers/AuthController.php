<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function index()
    {
        return view('auth/choix');
    }

    public function loginOperateur()
    {
        return view('auth/login_operateur');
    }
    public function loginClient()
    {
        return view('auth/login_client');
    }

    public function inscriptionClient()
    {
        $numero = $this->request->getGet('numero');
        return view('auth/inscription_client', ['numero' => $numero]);
    }
}
