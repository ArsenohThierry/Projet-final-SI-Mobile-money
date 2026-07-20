<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barème des frais</title>
</head>
<body>
    <h1>Barème des frais</h1>

    <a href="/bareme-frais/create">Ajouter un bareme</a>

    <h2>Filtrer</h2>
    <form method="GET" action="/bareme-frais">
        <label>Type operation :</label>
        <select name="id_type_operation">
            <option value="">Tous</option>
            <?php foreach ($types as $t): ?>
                <option value="<?= $t->id ?>" <?= $filters['id_type_operation'] == $t->id ? 'selected' : '' ?>><?= esc($t->libelle) ?></option>
            <?php endforeach; ?>
        </select>

        <label>Montant min :</label>
        <input type="number" step="0.01" name="montant_min" value="<?= esc($filters['montant_min']) ?>">

        <label>Montant max :</label>
        <input type="number" step="0.01" name="montant_max" value="<?= esc($filters['montant_max']) ?>">

        <label>Frais min :</label>
        <input type="number" step="0.01" name="frais_min" value="<?= esc($filters['frais_min']) ?>">

        <label>Frais max :</label>
        <input type="number" step="0.01" name="frais_max" value="<?= esc($filters['frais_max']) ?>">

        <label>Frais exact :</label>
        <input type="number" step="0.01" name="frais_exact" value="<?= esc($filters['frais_exact']) ?>">

        <button type="submit">Filtrer</button>
        <a href="/bareme-frais">Réinitialiser</a>
    </form>

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Type operation</th>
            <th>Montant min</th>
            <th>Montant max</th>
            <th>Frais</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($frais as $f): ?>
        <tr>
            <td><?= $f->id ?></td>
            <td><?= esc($f->type_libelle) ?></td>
            <td><?= $f->montant_min ?></td>
            <td><?= $f->montant_max ?></td>
            <td><?= $f->frais ?></td>
            <td>
                <a href="/bareme-frais/edit/<?= $f->id ?>">Modifier</a>
                <a href="/bareme-frais/delete/<?= $f->id ?>" onclick="return confirm('Supprimer ?')">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <a href="/">Retour</a>
</body>
</html>
