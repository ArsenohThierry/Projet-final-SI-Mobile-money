<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Prefixes</title>
</head>
<body>
    <h1>Prefixes</h1>

    <a href="/prefixe/create">Ajouter un prefixe</a>

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Prefixe</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($prefixes as $p): ?>
        <tr>
            <td><?= $p->id ?></td>
            <td><?= esc($p->prefixe) ?></td>
            <td>
                <a href="/prefixe/edit/<?= $p->id ?>">Modifier</a>
                <a href="/prefixe/delete/<?= $p->id ?>" onclick="return confirm('Supprimer ?')">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <a href="/">Retour</a>
</body>
</html>
