<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un prefixe</title>
</head>
<body>
    <h1>Ajouter un prefixe</h1>

    <form method="POST" action="/prefixe/store">
        <?= csrf_field() ?>
        <label>Prefixe :</label><br>
        <input type="text" name="prefixe" placeholder="Ex: 033" required><br><br>

        <button type="submit">Ajouter</button>
    </form>

    <br>
    <a href="/prefixe">Retour</a>
</body>
</html>
