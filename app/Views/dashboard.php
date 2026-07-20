<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Client</title>
</head>
<body>
    <h1>Mobile Money</h1>

    <h3>
    Client : <?= $client['nom'] ?>
    </h3>

    <h2>
    Solde : <?= $solde ?> Ar
    </h2>


    <a href="/depot">
        Faire un dépôt
    </a>

    <br>

    <a href="/retrait">
        Faire un retrait
    </a>

    <br>

    <a href="/transfert">
        Faire un transfert
    </a>

    <br>

    <a href="/historique">
        Voir historique
    </a>
</body>
</html>