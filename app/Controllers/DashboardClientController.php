<?php

namespace App\Controllers;

use App\Models\Client;
use App\Models\Transaction;

class DashboardClientController extends BaseController
{
    public function index()
    {

        $idClient = session()->get('id_client');

        $clientModel = new Client();
        $transactionModel = new Transaction();

        $data = [
            'client' => $clientModel->find($idClient),
            'solde' => $clientModel->getSolde($idClient),
            'historique' => $transactionModel->historique($idClient)
        ];

        return view('dashboard', $data);
    }

    public function historique()
    {
        $idClient = session()->get('id_client');

        $transactionModel = new Transaction();

        $data['historique'] = $transactionModel->historique($idClient);

        return view('historique', $data);
    }

    public function epargne() {
        $idClient = session()->get('id_client');

        $transactionModel = new Transaction();

        $data['historique'] = $transactionModel->historique($idClient);

        return view('historique', $data);
    }
}