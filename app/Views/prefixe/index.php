<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Préfixes — VolaAtHome</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="topbar">
        <a href="/operateur/dashboard" class="topbar-brand">VolaAtHome</a>
        <div class="topbar-nav">
            <a href="/operateur/dashboard">Dashboard</a>
            <a href="/client">Clients</a>
            <a href="/type-operation">Types</a>
            <a href="/bareme-frais">Barème</a>
            <a href="/operateur/logout" class="btn-logout">Déconnexion</a>
        </div>
    </div>

    <div class="page">
        <div class="page-header">
            <h1>Préfixes</h1>
            <a href="/prefixe/create" class="btn btn-primary">＋ Ajouter</a>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Préfixe</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($prefixes as $p): ?>
                    <tr>
                        <td><span class="badge badge-outline">#<?= $p->id ?></span></td>
                        <td style="font-weight:500;"><?= esc($p->prefixe) ?></td>
                        <td class="table-actions">
                            <a href="/prefixe/edit/<?= $p->id ?>">Modifier</a>
                            <a href="/prefixe/delete/<?= $p->id ?>" class="delete-link" onclick="return confirm('Supprimer ce préfixe ?')">Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
