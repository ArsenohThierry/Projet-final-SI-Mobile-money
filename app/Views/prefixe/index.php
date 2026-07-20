<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prefixes</title>
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
            <h1>Prefixes</h1>
            <a href="/prefixe/create" class="btn btn-primary">Ajouter</a>
        </div>

        <h2>Filtrer</h2>
        <form method="GET" action="/prefixe">
            <label>Operateur :</label>
            <select name="id_operateur">
                <option value="">Tous</option>
                <?php foreach ($operateurs as $o): ?>
                    <option value="<?= $o->id ?>" <?= $filters['id_operateur'] == $o->id ? 'selected' : '' ?>><?= esc($o->nom) ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn btn-primary">Filtrer</button>
            <a href="/prefixe">Reinitialiser</a>
        </form>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Prefixe</th>
                        <th>Operateur</th>
                        <th>% Commission</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($prefixes as $p): ?>
                    <tr>
                        <td><?= $p->id ?></td>
                        <td><?= esc($p->prefixe) ?></td>
                        <td><?= esc($p->operateur_nom) ?></td>
                        <td><?= $p->pct_comission ?>%</td>
                        <td>
                            <a href="/prefixe/edit/<?= $p->id ?>">Modifier</a>
                            <a href="/prefixe/delete/<?= $p->id ?>" onclick="return confirm('Supprimer ?')">Supprimer</a>
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
