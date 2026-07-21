<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retrait — VolaAtHome</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="topbar">
        <a href="/dashboard" class="topbar-brand">VolaAtHome</a>
        <div class="topbar-nav">
            <a href="/client/logout" class="btn-logout">Déconnexion</a>
        </div>
    </div>

    <div class="page page--narrow">
        <a href="/dashboard" class="back-link">Dashboard</a>

        <?php if(session()->getFlashdata('erreur')): ?>
            <div class="alert alert-error"><?= session()->getFlashdata('erreur') ?></div>
        <?php endif; ?>

        <div class="card">
            <div class="page-header" style="margin-bottom:1.5rem;">
                <h1 style="font-size:1.25rem;">－ Retrait</h1>
            </div>

            <form method="post">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label>Montant</label>
                    <input type="number" name="montant" step="0.01" min="1" placeholder="0" required>
                </div>

                <div class="form-group">
                    <label>
                        Frais retrait
                    </label>

                    <input type="text" id="frais" readonly value="0">
                </div>

                <button type="submit" class="btn btn-primary" style="width:100%;">Retirer</button>
            </form>
        </div>
    </div>


    <script>
        const montantInput = document.querySelector('input[name="montant"]');
        const fraisInput = document.getElementById('frais');

        montantInput.addEventListener('input', calculerFraisRetrait);

        async function calculerFraisRetrait() {
            if(!montantInput.value)
                return;

            let response = await fetch(
                "<?= base_url('client/calculer-frais-retrait') ?>",
                {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: "montant=" + montantInput.value
                }
            );

            let data = await response.json();

            document.getElementById('frais').value = data.frais;
        }
    </script>
</body>
</html>