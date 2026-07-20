<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un client</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <h1>Ajouter un client</h1>

    <form method="POST" action="/client/store">
        <?= csrf_field() ?>

        <label>Nom :</label><br>
        <input type="text" name="nom" required><br><br>

        <label>Numero :</label><br>
        <input type="text" name="numero" placeholder="Ex: 0341234567" required><br><br>

        <button type="submit">Ajouter</button>
    </form>

    <br>
    <a href="/client">Retour</a>
</body>
</html>
