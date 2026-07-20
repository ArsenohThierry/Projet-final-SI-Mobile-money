<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail client — VolaAtHome</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="topbar">
        <a href="/operateur/dashboard" class="topbar-brand">VolaAtHome</a>
        <div class="topbar-nav">
            <a href="/operateur/logout" class="btn-logout">Déconnexion</a>
        </div>
    </div>

    <div class="page">
        <a href="/client" class="back-link">Clients</a>

        <div class="page-header">
            <h1><?= esc($client['nom']) ?></h1>
            <a href="/client/edit/<?= $client['id'] ?>" class="btn btn-outline">Modifier</a>
        </div>

        <div class="info-grid">
            <div class="info-item">
                <div class="info-item-label">Numéro</div>
                <div class="info-item-value"><?= esc($client['numero']) ?></div>
            </div>
            <div class="info-item">
                <div class="info-item-label">Solde</div>
                <div class="info-item-value"><?= number_format($solde, 0, ',', ' ') ?> Ar</div>
            </div>
            <div class="info-item">
                <div class="info-item-label">Date de création</div>
                <div class="info-item-value"><?= $client['date_creation'] ?></div>
            </div>
        </div>

        <div class="section-title">Historique des opérations</div>

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
                    <?php foreach ($historique as $h): ?>
                    <tr>
                        <td><?= $h['date_transaction'] ?></td>
                        <td style="font-weight:500;"><?= esc($h['libelle']) ?></td>
                        <td>
                            <span class="badge <?= $h['sens'] === 'Crédit' ? 'badge-black' : 'badge-outline' ?>">
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
