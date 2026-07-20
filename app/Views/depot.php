<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Depot</title>
</head>
<body>
    <h1>Depot</h1>
    <form method="post" action="/depot">
        <label for="montant">Montant :</label>
        <input type="number" id="montant" name="montant" step="0.01" required>
        <button type="submit">Effectuer le depot</button>
    </form>
</body>
</html>