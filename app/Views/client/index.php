<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients — VolaAtHome</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="topbar">
        <a href="/operateur/dashboard" class="topbar-brand">VolaAtHome</a>
        <div class="topbar-nav">
            <a href="/operateur/dashboard">Dashboard</a>
            <a href="/prefixe">Préfixes</a>
            <a href="/type-operation">Types</a>
            <a href="/bareme-frais">Barème</a>
            <a href="/operateur/logout" class="btn-logout">Déconnexion</a>
        </div>
    </div>

    <div class="page">
        <div class="page-header">
            <h1>Clients</h1>
            <a href="/client/create" class="btn btn-primary">＋ Ajouter</a>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Numéro</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clients as $c): ?>
                    <tr>
                        <td><span class="badge badge-outline">#<?= $c['id'] ?></span></td>
                        <td style="font-weight:500;"><?= esc($c['nom']) ?></td>
                        <td><?= esc($c['numero']) ?></td>
                        <td class="table-actions">
                            <a href="/client/detail/<?= $c['id'] ?>">Détail</a>
                            <a href="/client/edit/<?= $c['id'] ?>">Modifier</a>
                            <a href="/client/delete/<?= $c['id'] ?>" class="delete-link" onclick="return confirm('Supprimer ce client ?')">Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
