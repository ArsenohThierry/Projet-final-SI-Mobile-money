<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Client</title>
</head>
<body>
    <h1>Connexion Client</h1>

    <form method="POST" action="/auth/login-client">
        <?= csrf_field() ?>
        <label>Numero de telephone :</label><br>
        <input type="text" name="numero" placeholder="Ex: 033123456" required><br><br>

        <button type="submit">Se connecter</button>
    </form>

    <br>
    <a href="/">Retour</a>
</body>
</html>
