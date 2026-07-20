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
                <h1 style="font-size:1.25rem;">→ Transfert</h1>
            </div>

            <form method="post">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label>Numéro destinataire</label>
                    <input type="text" name="numero" placeholder="Ex: 033 12 345 67" required>
                </div>

                <div class="form-group">
                    <label>Montant</label>
                    <input type="number" name="montant" step="0.01" min="1" placeholder="0" required>
                </div>

                <button type="submit" class="btn btn-primary" style="width:100%;">Transférer</button>
            </form>
        </div>
    </div>
</body>
</html>