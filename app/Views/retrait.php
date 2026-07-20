<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retrait</title>
</head>
<body>
    <h2>Retrait</h2>


    <?php if(session()->getFlashdata('erreur')): ?>

    <p>
    <?= session()->getFlashdata('erreur') ?>
    </p>

    <?php endif; ?>


    <form method="post">

        Montant :

        <input 
            type="number"
            name="montant"
            required
        >

        <button>
            Retirer
        </button>

    </form>
</body>
</html>