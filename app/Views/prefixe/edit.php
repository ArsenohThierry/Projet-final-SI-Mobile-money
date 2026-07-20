<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le prefixe</title>
</head>
<body>
    <h1>Modifier le prefixe</h1>

    <form method="POST" action="/prefixe/update/<?= $prefixe->id ?>">
        <?= csrf_field() ?>
        <label>Prefixe :</label><br>
        <input type="text" name="prefixe" value="<?= esc($prefixe->prefixe) ?>" required><br><br>

        <button type="submit">Modifier</button>
    </form>

    <br>
    <a href="/prefixe">Retour</a>
</body>
</html>
