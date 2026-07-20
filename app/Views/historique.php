<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique</title>
</head>
<body>
    <h2>Historique</h2>


    <table border="1">

    <tr>
        <th>Date</th>
        <th>Operation</th>
        <th>Sens</th>
        <th>Montant</th>
    </tr>


    <?php foreach($historique as $h): ?>

    <tr>

    <td>
    <?= $h['date_transaction'] ?>
    </td>


    <td>
    <?= $h['libelle'] ?>
    </td>


    <td>
    <?= $h['sens'] ?>
    </td>


    <td>
    <?= $h['montant_mouvement'] ?>
    </td>


    </tr>


    <?php endforeach; ?>


    </table>
</body>
</html>