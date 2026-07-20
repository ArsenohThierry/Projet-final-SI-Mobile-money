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
        <a href="/dashboard" class="topbar-brand">Mobile Money</a>
        <div class="topbar-nav">
            <a href="/client/logout" class="btn-logout">Déconnexion</a>
        </div>
    </div>

    <div class="page">
        <a href="/dashboard" class="back-link">Dashboard</a>

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
                        <th>Destinataire / Expéditeur</th>
                        <th>Frais</th>
                        <th>Commission</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($historique as $h):
                        $frais = 0;
                        $commission = 0;
                        $montantTotal = $h['montant_mouvement'];
                        $montantTransaction = $h['montant_transaction'];

                        if ($h['libelle'] === 'RETRAIT' && $h['sens'] === 'DEBIT') {
                            $frais = $montantTotal - $montantTransaction;
                        } elseif ($h['libelle'] === 'TRANSFERT' && $h['sens'] === 'DEBIT') {
                            $totalFraisCommission = $montantTotal - $montantTransaction;
                            if (!empty($h['pct_comission'])) {
                                $commission = $montantTransaction * ($h['pct_comission'] / 100);
                                $frais = $totalFraisCommission - $commission;
                            } else {
                                $frais = $totalFraisCommission;
                            }
                        }

                        $destinataire = '';
                        if ($h['libelle'] === 'TRANSFERT') {
                            if ($h['sens'] === 'DEBIT') {
                                if (!empty($h['numero_counterpart_client'])) {
                                    $destinataire = esc($h['numero_counterpart_client']) . ' — ' . esc($h['nom_counterpart_client']);
                                } elseif (!empty($h['numero_counterpart'])) {
                                    $destinataire = esc($h['numero_counterpart']) . ' (autre opérateur)';
                                }
                            } else {
                                if (!empty($h['numero_counterpart_client'])) {
                                    $destinataire = esc($h['numero_counterpart_client']) . ' — ' . esc($h['nom_counterpart_client']);
                                } elseif (!empty($h['numero_counterpart'])) {
                                    $destinataire = esc($h['numero_counterpart']) . ' (autre opérateur)';
                                }
                            }
                        }
                    ?>
                    <tr>
                        <td><?= $h['date_transaction'] ?></td>
                        <td style="font-weight:500;"><?= $h['libelle'] ?></td>
                        <td>
                            <span class="badge <?= ($h['sens'] === 'CREDIT') ? 'badge-black' : 'badge-outline' ?>">
                                <?= $h['sens'] ?>
                            </span>
                        </td>
                        <td style="font-weight:600;"><?= number_format($montantTotal, 0, ',', ' ') ?> Ar</td>
                        <td><?= $destinataire ?: '—' ?></td>
                        <td><?= $frais > 0 ? number_format($frais, 0, ',', ' ') . ' Ar' : '—' ?></td>
                        <td><?= $commission > 0 ? number_format($commission, 0, ',', ' ') . ' Ar' : '—' ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>