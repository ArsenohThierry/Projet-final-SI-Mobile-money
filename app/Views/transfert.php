<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfert — VolaAtHome</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="topbar">
        <a href="/client/dashboard" class="topbar-brand">VolaAtHome</a>
        <div class="topbar-nav">
            <a href="/client/logout" class="btn-logout">Déconnexion</a>
        </div>
    </div>

    <div class="page page--narrow">

        <a href="<?= base_url('/dashboard'); ?>" class="back-link">
            Dashboard
        </a>

        <?php if(session()->getFlashdata('erreur')): ?>
            <div class="alert alert-error">
                <?= session()->getFlashdata('erreur') ?>
            </div>
        <?php endif; ?>

        <div class="card">

            <div class="page-header" style="margin-bottom:1.5rem;">
                <h1 style="font-size:1.25rem;">→ Transfert</h1>
            </div>

            <form method="post">

                <?= csrf_field() ?>

                <div class="form-group">
                    <label>
                        Numéro(s) destinataire
                    </label>

                    <textarea
                        name="numero"
                        id="numero"
                        placeholder="Un numéro par ligne&#10;Ex: 0341234567"
                        required></textarea>

                    <small>
                        Plusieurs numéros = transfert multiple (même opérateur uniquement)
                    </small>
                </div>

                <div class="form-group">
                    <label>Montant total</label>

                    <input
                        type="number"
                        name="montant"
                        id="montant"
                        step="0.01"
                        min="1"
                        required>
                </div>

                <div class="form-group">
                    <label>
                        Frais transfert
                    </label>

                    <input
                        type="text"
                        id="frais"
                        readonly
                        value="0">
                </div>

                <div class="form-group">
                    <label>
                        <input
                            type="checkbox"
                            name="frais_retrait"
                            id="frais_retrait"
                            value="1"
                            disabled>

                        Prendre en charge les frais de retrait
                    </label>

                    <small id="message-operateur"></small>
                </div>

                <button
                    type="submit"
                    class="btn btn-primary"
                    style="width:100%;">

                    Transférer

                </button>

            </form>

        </div>

    </div>

    <script>

    const numero = document.getElementById('numero');
    const montant = document.getElementById('montant');

    const checkbox =
    document.getElementById('frais_retrait');

    const message =
    document.getElementById('message-operateur');

    numero.addEventListener('input', verifierOperateur);

    async function verifierOperateur(){

        let lignes =
            numero.value.trim().split("\n")
            .map(n => n.trim())
            .filter(n => n !== "");

        if(lignes.length === 0){
            checkbox.disabled = true;
            checkbox.checked = false;
            message.innerHTML = "";
            return;
        }

        if(lignes.length === 1){
            let response = await fetch(
                "<?= base_url('client/verifier-operateur') ?>",
                {
                    method:"POST",
                    headers:{ "Content-Type": "application/x-www-form-urlencoded" },
                    body: "numero=" + lignes[0]
                }
            );
            let data = await response.json();

            if(data.memeOperateur){
                checkbox.disabled = false;
                message.innerHTML = "Même opérateur — frais de retrait optionnels";
            } else {
                checkbox.disabled = true;
                checkbox.checked = false;
                message.innerHTML = "Opérateurs différents — pas de frais de retrait";
            }
            return;
        }

        let tousMemeOperateur = true;

        for(let n of lignes){
            let response = await fetch(
                "<?= base_url('client/verifier-operateur') ?>",
                {
                    method:"POST",
                    headers:{ "Content-Type": "application/x-www-form-urlencoded" },
                    body: "numero=" + n
                }
            );
            let data = await response.json();

            if(!data.memeOperateur){
                tousMemeOperateur = false;
                break;
            }
        }

        checkbox.disabled = true;
        checkbox.checked = false;

        if(tousMemeOperateur){
            message.innerHTML = "Transfert multiple — tous même opérateur";
        } else {
            message.innerHTML = "Certains numéros sont d'un autre opérateur — transfert multiple inter-op non autorisé";
        }
    }

    montant.addEventListener('input', calculerFrais);

    async function calculerFrais(){

        if(!montant.value)
            return;

        let response =
        await fetch(
            "<?= base_url('client/calculer-frais') ?>",
            {
            method:"POST",
            headers:{
                "Content-Type":
                "application/x-www-form-urlencoded"
            },
            body:
            "montant="+montant.value
            }
        );

        let data =
        await response.json();

        document.getElementById('frais').value =
            data.frais;
    }

    </script>
    
</body>
</html>
