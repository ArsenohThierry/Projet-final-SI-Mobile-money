<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Montants à envoyer — VolaAtHome</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="topbar">
        <a href="/operateur/dashboard" class="topbar-brand">VolaAtHome</a>
        <div class="topbar-nav">
            <span style="color:var(--gray-500);font-size:0.85rem;">Opérateur</span>
            <a href="/operateur/logout" class="btn-logout">Déconnexion</a>
        </div>
    </div>

    <div class="page">
        <div class="page-header">
            <h1>Montants à envoyer aux autres opérateurs</h1>
        </div>

        <!-- Résumé par opérateur -->
        <h2>Résumé</h2>
        <div class="stats-grid" style="margin-bottom:2rem;">
            <?php if (empty($resume)): ?>
                <div class="card">
                    <div class="card-title">Aucun transfert inter-opérateur</div>
                </div>
            <?php else: ?>
                <?php foreach ($resume as $r): ?>
                    <a href="/operateur/montants-a-envoyer?id_operateur=<?= $r->operateur_id ?>" class="card" style="text-decoration:none;">
                        <div class="card-title"><?= esc($r->operateur_nom) ?></div>
                        <div class="card-value"><?= number_format($r->total_a_envoyer, 0, ',', ' ') ?> Ar</div>
                        <div style="font-size:0.8rem;color:var(--gray-500);margin-top:0.25rem;">
                            Montant: <?= number_format($r->total_montant, 0, ',', ' ') ?> Ar |
                            Commission: <?= number_format($r->total_commission, 0, ',', ' ') ?> Ar
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Filtre -->
        <h2>Détails</h2>
        <form method="GET" action="/operateur/montants-a-envoyer">
            <label>Opérateur :</label>
            <select name="id_operateur" style="width:30%">
                <option value="">Tous</option>
                <?php foreach ($operateurs as $o): ?>
                    <option value="<?= $o->id ?>" <?= $filters['id_operateur'] == $o->id ? 'selected' : '' ?>><?= esc($o->nom) ?></option>
                <?php endforeach; ?>
            </select>
            <br>
            <button style="margin-top: 20px" type="submit" class="btn btn-primary">Filtrer</button>
            <a href="/operateur/montants-a-envoyer" style="margin-left:10px">Réinitialiser</a>
        </form>

        <!-- Liste détaillée -->
        <div class="table-wrapper" style="margin-top:1rem;">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Numéro destinataire</th>
                        <th>Opérateur</th>
                        <th>Montant</th>
                        <th>Commission</th>
                        <th>Total à envoyer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($details)): ?>
                        <tr>
                            <td colspan="6" style="text-align:center;">Aucun transfert inter-opérateur</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($details as $d): ?>
                            <tr>
                                <td><?= esc($d->date_transaction) ?></td>
                                <td><?= esc($d->numero) ?></td>
                                <td><?= esc($d->operateur_nom) ?></td>
                                <td><?= number_format($d->montant, 0, ',', ' ') ?> Ar</td>
                                <td><?= number_format($d->commission, 0, ',', ' ') ?> Ar</td>
                                <td><strong><?= number_format($d->total_a_envoyer, 0, ',', ' ') ?> Ar</strong></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <br>
        <a href="/operateur/dashboard" class="back-link">Retour</a>
    </div>
</body>
</html>
