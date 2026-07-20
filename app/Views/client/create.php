<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un client — VolaAtHome</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="topbar">
        <a href="/operateur/dashboard" class="topbar-brand">VolaAtHome</a>
        <div class="topbar-nav">
            <a href="/operateur/logout" class="btn-logout">Déconnexion</a>
        </div>
    </div>

    <div class="page page--narrow">
        <a href="/client" class="back-link">Clients</a>

        <div class="card">
            <div class="page-header" style="margin-bottom:1.5rem;">
                <h1 style="font-size:1.25rem;">Ajouter un client</h1>
            </div>

            <form method="POST" action="/client/store">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label>Nom</label>
                    <input type="text" name="nom" placeholder="Nom complet" required>
                </div>

                <div class="form-group">
                    <label>Numéro</label>
                    <input type="text" name="numero" placeholder="Ex: 034 12 345 67" required>
                </div>

                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
        </div>
    </div>
</body>
</html>
