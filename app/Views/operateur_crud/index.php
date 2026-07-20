<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Operateurs</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="topbar">
        <a href="/operateur/dashboard" class="topbar-brand">VolaAtHome</a>
        <div class="topbar-nav">
            <a href="/operateur/logout" class="btn-logout">Deconnexion</a>
        </div>
    </div>

    <div class="page">
        <div class="page-header">
            <h1>Operateurs</h1>
            <a href="/operateur-crud/create" class="btn btn-primary">Ajouter</a>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>% Commission</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($operateurs as $o): ?>
                    <tr>
                        <td><?= $o->id ?></td>
                        <td><?= esc($o->nom) ?></td>
                        <td><?= $o->pct_comission ?>%</td>
                        <td>
                            <a href="/operateur-crud/edit/<?= $o->id ?>">Modifier</a>
                            <a href="/operateur-crud/delete/<?= $o->id ?>" onclick="return confirm('Supprimer ?')">Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <br>
        <a href="/operateur/dashboard" class="back-link">Retour</a>
    </div>
</body>
</html>
