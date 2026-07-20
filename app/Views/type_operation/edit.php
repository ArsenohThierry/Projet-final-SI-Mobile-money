<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le type d'operation</title>
</head>

<body>
    <h1>Modifier le type d'operation</h1>

    <form method="POST" action="/type-operation/update/<?= $type->id ?>">
        <?= csrf_field() ?>

        <label>Id :</label><br>
        <input type="text" name="id" value="<?= esc($type->id) ?>" required><br><br>

        <label>Libelle :</label><br>
        <input type="text" name="libelle" value="<?= esc($type->libelle) ?>" required><br><br>

        <button type="submit">Modifier</button>
    </form>

    <br>
    <a href="/type-operation">Retour</a>
</body>

</html>