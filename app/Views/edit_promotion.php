<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le type — VolaAtHome</title>
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
        <a href="/type-operation" class="back-link">Promotoins</a>


            <form method="POST" action="/type-operation/update/<?= $type->id ?>">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label>Libellé</label>
                    <input type="text" name="libelle" value="<?= esc($type->libelle) ?>" required>
                </div>

                <button type="submit" class="btn btn-primary">Modifier</button>
            </form>
        </div>
    </div>
</body>

</html>