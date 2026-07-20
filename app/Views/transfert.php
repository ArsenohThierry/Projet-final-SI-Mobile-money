<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfert</title>
</head>
<body>
    <h2>Transfert</h2>


    <?php if(session()->getFlashdata('erreur')): ?>

    <p>
    <?= session()->getFlashdata('erreur') ?>
    </p>

    <?php endif; ?>


    <form method="post">


    Numéro destinataire :

    <input 
        type="text"
        name="numero"
        required
    >


    Montant :

    <input 
        type="number"
        name="montant"
        required
    >


    <button>
    Transférer
    </button>


    </form>
</body>
</html>