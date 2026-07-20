<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique — Mobile Money</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="topbar">
        <a href="/client/dashboard" class="topbar-brand">Mobile Money</a>
        <div class="topbar-nav">
            <a href="/client/logout" class="btn-logout">Déconnexion</a>
        </div>
    </div>

    <div class="page">
        <a href="/client/dashboard" class="back-link">Dashboard</a>

        <div class="page-header">
            <h1>Historique</h1>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Opération</th>
                        <th>Sens</th>
                        <th>Montant</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($historique as $h): ?>
                    <tr>
                        <td><?= $h['date_transaction'] ?></td>
                        <td style="font-weight:500;"><?= $h['libelle'] ?></td>
                        <td>
                            <span class="badge <?= ($h['sens'] === 'Crédit' || $h['sens'] === 'credit') ? 'badge-black' : 'badge-outline' ?>">
                                <?= $h['sens'] ?>
                            </span>
                        </td>
                        <td style="font-weight:600;"><?= number_format($h['montant_mouvement'], 0, ',', ' ') ?> Ar</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>