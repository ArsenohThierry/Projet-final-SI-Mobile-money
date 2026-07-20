<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barème des frais — VolaAtHome</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="topbar">
        <a href="/operateur/dashboard" class="topbar-brand">VolaAtHome</a>
        <div class="topbar-nav">
            <a href="/operateur/dashboard">Dashboard</a>
            <a href="/client">Clients</a>
            <a href="/prefixe">Préfixes</a>
            <a href="/type-operation">Types</a>
            <a href="/operateur/logout" class="btn-logout">Déconnexion</a>
        </div>
    </div>

    <div class="page">
        <div class="page-header">
            <h1>Barème des frais</h1>
            <a href="/bareme-frais/create" class="btn btn-primary">＋ Ajouter</a>
        </div>

        <!-- Filter Bar -->
        <form method="GET" action="/bareme-frais">
            <div class="filter-bar">
                <div class="form-group">
                    <label>Type d'opération</label>
                    <select name="id_type_operation">
                        <option value="">Tous</option>
                        <?php foreach ($types as $t): ?>
                            <option value="<?= $t->id ?>" <?= $filters['id_type_operation'] == $t->id ? 'selected' : '' ?>><?= esc($t->libelle) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Montant min</label>
                    <input type="number" step="0.01" name="montant_min" value="<?= esc($filters['montant_min']) ?>">
                </div>
                <div class="form-group">
                    <label>Montant max</label>
                    <input type="number" step="0.01" name="montant_max" value="<?= esc($filters['montant_max']) ?>">
                </div>
                <div class="form-group">
                    <label>Frais exact</label>
                    <input type="number" step="0.01" name="frais_exact" value="<?= esc($filters['frais_exact']) ?>">
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Filtrer</button>
                <a href="/bareme-frais" class="filter-reset">Réinitialiser</a>
            </div>
        </form>

        <!-- Table -->
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type d'opération</th>
                        <th>Montant min</th>
                        <th>Montant max</th>
                        <th>Frais</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($frais as $f): ?>
                    <tr>
                        <td><span class="badge badge-outline">#<?= $f->id ?></span></td>
                        <td style="font-weight:500;"><?= esc($f->type_libelle) ?></td>
                        <td><?= number_format($f->montant_min, 0, ',', ' ') ?></td>
                        <td><?= number_format($f->montant_max, 0, ',', ' ') ?></td>
                        <td style="font-weight:600;"><?= number_format($f->frais, 0, ',', ' ') ?></td>
                        <td class="table-actions">
                            <a href="/bareme-frais/edit/<?= $f->id ?>">Modifier</a>
                            <a href="/bareme-frais/delete/<?= $f->id ?>" class="delete-link" onclick="return confirm('Supprimer ce barème ?')">Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
