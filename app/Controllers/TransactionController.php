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

            $numeros = $this->request->getPost('numero');
            $montant = $this->request->getPost('montant');

            $listeNumeros = preg_split(
                "/\r\n|\n|\r/",
                trim($numeros)
            );

            $listeNumeros = array_filter($listeNumeros, fn($n) => trim($n) !== '');

            if (count($listeNumeros) === 0) {
                return redirect()->back()->with('erreur', 'Veuillez entrer au moins un numéro.');
            }

            $prefixeModel = new PrefixeModel();
            $clientModel = new Client();
            $idClient = session()->get('id_client');
            $sender = $clientModel->find($idClient);
            $senderOperateur = $prefixeModel->getOperateurByNumero($sender['numero']);

            $isMultiTransfer = count($listeNumeros) > 1;

            if ($isMultiTransfer) {
                $idDestinataires = [];

                foreach ($listeNumeros as $numero) {
                    $numero = trim($numero);

                    $recipientOperateur = $prefixeModel->getOperateurByNumero($numero);
                    if ($recipientOperateur === null) {
                        return redirect()->back()->with('erreur', "Numéro non valide : " . $numero);
                    }

                    if ($recipientOperateur !== $senderOperateur) {
                        return redirect()->back()->with('erreur', "Transfert multiple : tous les numéros doivent être du même opérateur. " . $numero . " est d'un autre opérateur.");
                    }

                    $destinataire = $clientModel->getByNumero($numero);
                    if (!$destinataire) {
                        return redirect()->back()->with('erreur', "Client introuvable : " . $numero);
                    }

                    $idDestinataires[] = $destinataire['id'];
                }

                $transaction = new Transaction();
                $priseEnChargeRetrait = $this->request->getPost('frais_retrait') ? true : false;

                if (!$transaction->transfert($idClient, $idDestinataires, $montant, $priseEnChargeRetrait)) {
                    return redirect()->back()->with('erreur', 'Transfert impossible. Vérifiez votre solde ou les conditions.');
                }
            } else {
                $numero = trim($listeNumeros[0]);
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
                    $priseEnChargeRetrait = $this->request->getPost('frais_retrait') ? true : false;

                    if (!$transaction->transfert($idClient, [$destinataire['id']], $montant, $priseEnChargeRetrait)) {
                        return redirect()->back()->with('erreur', 'Solde insuffisant');
                    }
                } else {
                    $transaction = new Transaction();
                    if (!$transaction->transfertAutreOperateur($idClient, $numero, $montant)) {
                        return redirect()->back()->with('erreur', 'Solde insuffisant');
                    }
                }
            }

            return redirect()->to('/dashboard');
        }

        return view('transfert');
    }

    public function verifierOperateur(){
        $numero = $this->request->getPost('numero');

        $client = new Client();

        $expediteur = $client->find(session()->get('id_client'));

        // on découpe en lignes et on nettoie les vides/espaces
        $numeros = array_filter(
            array_map('trim', explode("\n", $numero)),
            fn($n) => $n !== ''
        );

        if (count($numeros) === 0) {
            return $this->response->setJSON(['memeOperateur' => false]);
        }

        $meme = true;

        foreach ($numeros as $n) {
            if (!$client->memeOperateur($expediteur['numero'], $n)) {
                $meme = false;
                break;
            }
        }

        return $this->response->setJSON([
            'memeOperateur' => $meme
        ]);
    }

    public function calculerFrais(){
        $montant =
            $this->request->getPost('montant');

        $bareme = new \App\Models\BaremeFrais();

        $frais =
            $bareme->calculerFrais(
                3,
                $montant
            );

        return $this->response->setJSON([
            'frais'=>$frais
        ]);
    }


    public function calculerFraisRetrait() {
        $montant = $this->request->getPost('montant');

        $bareme = new \App\Models\BaremeFrais();

        $frais = $bareme->calculerFrais(2, $montant);

        return $this->response->setJSON([
            'frais' => $frais
        ]);
    }
    
}
