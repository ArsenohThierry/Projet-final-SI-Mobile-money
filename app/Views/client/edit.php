<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le client</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <h1>Modifier le client</h1>

    <form method="POST" action="/client/update/<?= $client->id ?>">
        <?= csrf_field() ?>

        <label>Nom :</label><br>
        <input type="text" name="nom" value="<?= esc($client->nom) ?>" required><br><br>

        <label>Numero :</label><br>
        <input type="text" name="numero" value="<?= esc($client->numero) ?>" required><br><br>

        <button type="submit">Modifier</button>
    </form>

    <br>
    <a href="/client">Retour</a>
</body>
</html>
