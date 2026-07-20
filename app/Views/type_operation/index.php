<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Types d'operations</title>
</head>
<body>
    <h1>Types d'operations</h1>

    <a href="/type-operation/create">Ajouter un type</a>

    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Libelle</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($types as $t): ?>
        <tr>
            <td><?= $t->id ?></td>
            <td><?= esc($t->libelle) ?></td>
            <td>
                <a href="/type-operation/edit/<?= $t->id ?>">Modifier</a>
                <a href="/type-operation/delete/<?= $t->id ?>" onclick="return confirm('Supprimer ?')">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <a href="/">Retour</a>
</body>
</html>
