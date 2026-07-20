<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le bareme</title>
</head>
<body>
    <h1>Modifier le bareme</h1>

    <form method="POST" action="/bareme-frais/update/<?= $frais->id ?>">
        <?= csrf_field() ?>

        <label>Type d'operation :</label><br>
        <select name="id_type_operation" required>
            <?php foreach ($types as $t): ?>
                <option value="<?= $t->id ?>" <?= $frais->id_type_operation == $t->id ? 'selected' : '' ?>><?= esc($t->libelle) ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Montant min :</label><br>
        <input type="number" step="0.01" name="montant_min" value="<?= $frais->montant_min ?>" required><br><br>

        <label>Montant max :</label><br>
        <input type="number" step="0.01" name="montant_max" value="<?= $frais->montant_max ?>" required><br><br>

        <label>Frais :</label><br>
        <input type="number" step="0.01" name="frais" value="<?= $frais->frais ?>" required><br><br>

        <button type="submit">Modifier</button>
    </form>

    <br>
    <a href="/bareme-frais">Retour</a>
</body>
</html>
