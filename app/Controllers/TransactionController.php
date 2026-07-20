<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Transaction;
use App\Models\Client;
use App\Models\PrefixeModel;
use CodeIgniter\HTTP\ResponseInterface;

class TransactionController extends BaseController
{
    public function depot() {
        if ($this->request->getMethod() == "POST") {
            $montant = $this->request->getPost('montant');
            $idClient = session()->get('id_client');

            $transaction = new Transaction();

            $transaction->depot($idClient, $montant);   

            return redirect()->to('/dashboard');
        }

        return view('depot');
    }

    public function retrait() {
        if ($this->request->getMethod() == "POST") {
            $montant = $this->request->getPost('montant');
            $idClient = session()->get('id_client');

            $transaction = new Transaction();

            if (!$transaction->retrait($idClient, $montant)) {
                return redirect() ->back()->with('error', 'Solde insuffisant pour effectuer le retrait.');
            }
            return redirect()->to('/dashboard');
        }

        return view('retrait');
    }


    public function transfert()
    {
        if ($this->request->getMethod() == "POST") {

            $numero = $this->request->getPost('numero');
            $montant = $this->request->getPost('montant');

            $prefixeModel = new PrefixeModel();
            if (!$prefixeModel->estValide($numero)) {
                return redirect()->back()->with('erreur', 'Numero non Valide');
            }

            $clientModel = new Client();

            $destinataire = $clientModel->getByNumero($numero);

            if (!$destinataire) {
                return redirect()->back()->with('erreur', 'Client introuvable');
            }

            $transaction = new Transaction();

            if (
                !$transaction->transfert(
                    session()->get('id_client'),
                    $destinataire['id'],
                    $montant
                )
            ) {
                return redirect()->back()->with('erreur', 'Solde insuffisant');
            }

            return redirect()->to('/dashboard');
        }

        return view('transfert');
    }
}
