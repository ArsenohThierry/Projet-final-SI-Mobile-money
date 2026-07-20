<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier operateur</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="topbar">
        <a href="/operateur/dashboard" class="topbar-brand">VolaAtHome</a>
        <div class="topbar-nav">
            <a href="/operateur/logout" class="btn-logout">Deconnexion</a>
        </div>
    </div>

    <div class="page page--narrow">
        <a href="/operateur-crud" class="back-link">Operateurs</a>

        <div class="card">
            <div class="page-header" style="margin-bottom:1.5rem;">
                <h1 style="font-size:1.25rem;">Modifier operateur</h1>
            </div>

            <form method="POST" action="/operateur-crud/update/<?= $operateur->id ?>">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label>Nom</label>
                    <input type="text" name="nom" value="<?= esc($operateur->nom) ?>" required>
                </div>

                <div class="form-group">
                    <label>% Commission</label>
                    <input type="number" step="0.01" name="pct_comission" value="<?= $operateur->pct_comission ?>" required>
                </div>

                <button type="submit" class="btn btn-primary" style="width:100%;">Modifier</button>
            </form>
        </div>
    </div>
</body>
</html>
