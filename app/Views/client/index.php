<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des clients</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <h1>Clients</h1>

    <a href="/client/create">Ajouter un client</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Numero</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($clients as $c): ?>
        <tr>
            <td><?= $c->id ?></td>
            <td><?= esc($c->nom) ?></td>
            <td><?= esc($c->numero) ?></td>
            <td>
                <a href="/client/edit/<?= $c->id ?>">Modifier</a>
                <a href="/client/delete/<?= $c->id ?>" onclick="return confirm('Supprimer ?')">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <a href="/">Retour</a>
</body>
</html>
