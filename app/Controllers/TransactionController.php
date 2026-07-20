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


            // Transformer textarea en tableau
            $listeNumeros = preg_split(
                "/\r\n|\n|\r/",
                trim($numeros)
            );


            $prefixeModel = new PrefixeModel();
            $clientModel = new Client();


            $idDestinataires = [];


            foreach ($listeNumeros as $numero) {


                // vérifier le préfixe
                if (!$prefixeModel->estValide($numero)) {
                    return redirect()
                        ->back()
                        ->with('erreur', "Numéro non valide : ".$numero);
                }


                // chercher client
                $destinataire = $clientModel->getByNumero($numero);


                if (!$destinataire) {
                    return redirect()
                        ->back()
                        ->with('erreur', "Client introuvable : ".$numero);
                }


                $idDestinataires[] = $destinataire['id'];
            }



            $transaction = new Transaction();


            $priseEnChargeRetrait = 
                $this->request->getPost('frais_retrait') ? true : false;



            if (!$transaction->transfert(
                session()->get('id_client'),
                $idDestinataires,
                $montant,
                $priseEnChargeRetrait
            )) {

                return redirect()
                    ->back()
                    ->with(
                        'erreur',
                        'Transfert impossible. Vérifiez votre solde ou les conditions.'
                    );
            }


            return redirect()->to('/dashboard');
        }


        return view('transfert');
    }

    public function verifierOperateur(){
        $numero = $this->request->getPost('numero');

        $client = new Client();


        $expediteur =
            $client->find(session()->get('id_client'));


        $meme =
            $client->memeOperateur(
                $expediteur['numero'],
                $numero
            );


        return $this->response->setJSON([
            'memeOperateur'=>$meme
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
}
