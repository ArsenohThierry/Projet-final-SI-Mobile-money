<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Operateur</title>
</head>
<body>
    <h1>Connexion Operateur</h1>

    <?php if (!empty($error ?? null)): ?>
        <p style="color:red;"><?= esc($error) ?></p>
    <?php endif; ?>

    <form method="POST" action="/auth/login-operateur">
        <?= csrf_field() ?>
        <label>Email :</label><br>
        <input type="text" name="email" required><br><br>

        <label>Mot de passe :</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Se connecter</button>
    </form>

    <br>
    <a href="/">Retour</a>
</body>
</html>
