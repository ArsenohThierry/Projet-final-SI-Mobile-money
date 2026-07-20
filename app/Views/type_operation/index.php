<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Types d'opération — VolaAtHome</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="topbar">
        <a href="/operateur/dashboard" class="topbar-brand">VolaAtHome</a>
        <div class="topbar-nav">
            <a href="/operateur/dashboard">Dashboard</a>
            <a href="/client">Clients</a>
            <a href="/prefixe">Préfixes</a>
            <a href="/bareme-frais">Barème</a>
            <a href="/operateur/logout" class="btn-logout">Déconnexion</a>
        </div>
    </div>

    <div class="page">
        <div class="page-header">
            <h1>Types d'opération</h1>
            <a href="/type-operation/create" class="btn btn-primary">＋ Ajouter</a>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Libellé</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($types as $t): ?>
                    <tr>
                        <td><span class="badge badge-outline">#<?= $t->id ?></span></td>
                        <td style="font-weight:500;"><?= esc($t->libelle) ?></td>
                        <td class="table-actions">
                            <a href="/type-operation/edit/<?= $t->id ?>">Modifier</a>
                            <a href="/type-operation/delete/<?= $t->id ?>" class="delete-link" onclick="return confirm('Supprimer ce type ?')">Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
