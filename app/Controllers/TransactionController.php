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

            $clientModel = new Client();
            $prefixeModel = new PrefixeModel();

            $idClient = session()->get('id_client');
            $sender = $clientModel->find($idClient);
            $senderOperateur = $prefixeModel->getOperateurByNumero($sender['numero']);
            $recipientOperateur = $prefixeModel->getOperateurByNumero($numero);

            if ($recipientOperateur === null) {
                return redirect()->back()->with('erreur', 'Numero non Valide');
            }

            if ($senderOperateur === $recipientOperateur) {
                $destinataire = $clientModel->getByNumero($numero);

                if (!$destinataire) {
                    return redirect()->back()->with('erreur', 'Client introuvable');
                }

                $transaction = new Transaction();

                if (
                    !$transaction->transfert(
                        $idClient,
                        $destinataire['id'],
                        $montant
                    )
                ) {
                    return redirect()->back()->with('erreur', 'Solde insuffisant');
                }
            } else {
                $transaction = new Transaction();
                if (
                    !$transaction->transfertAutreOperateur($idClient, $numero, $montant)
                ) {
                    return redirect()->back()->with('erreur', 'Solde insuffisant');
                }
            }

            return redirect()->to('/dashboard');
        }

        return view('transfert');
    }
}
