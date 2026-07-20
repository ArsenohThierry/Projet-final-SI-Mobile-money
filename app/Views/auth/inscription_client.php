<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Client</title>
</head>
<body>
    <h1>Inscription Client</h1>
    <p>Numero : <?= esc($numero ?? '') ?></p>

    <?php if (!empty($error ?? null)): ?>
        <p style="color:red;"><?= esc($error) ?></p>
    <?php endif; ?>

    <form method="POST" action="/client/inscription">
        <?= csrf_field() ?>
        <input type="hidden" name="numero" value="<?= esc($numero ?? '') ?>">

        <label>Votre nom :</label><br>
        <input type="text" name="nom" required><br><br>

        <button type="submit">Creer mon compte</button>
    </form>

    <br>
    <a href="/">Retour</a>
</body>
</html>
