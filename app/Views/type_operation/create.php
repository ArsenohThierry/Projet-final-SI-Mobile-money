<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un type d'operation</title>
</head>
<body>
    <h1>Ajouter un type d'operation</h1>

    <form method="POST" action="/type-operation/store">
        <?= csrf_field() ?>

        <label>Libelle :</label><br>
        <input type="text" name="libelle" placeholder="Ex: Depot" required><br><br>
        <button type="submit">Ajouter</button>
    </form>

    <br>
    <a href="/type-operation">Retour</a>
</body>
</html>
