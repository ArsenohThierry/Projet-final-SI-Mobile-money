<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Opérateur — VolaAtHome</title>
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
        <!-- Stats -->
        <div class="stats-grid">
            <div class="card">
                <div class="card-title">Total des gains </div>
                <div class="card-value"><?= number_format($totalGains, 0, ',', ' ') ?> Ar</div>
            </div>
            <div class="card">
                <div class="card-title">Total des gains (Autres operateurs)</div>
                <div class="card-value"><?= number_format($totalGainsAutresOperateurs, 0, ',', ' ') ?> Ar</div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="page-header">
            <h2>Gestion</h2>
        </div>

        <div class="actions-grid">
            <a href="/client" class="action-card">
                <div class="action-card-icon">👤</div>
                <div class="action-card-label">Clients</div>
                <div class="action-card-desc">Gérer les comptes clients</div>
            </a>

            <a href="/prefixe" class="action-card">
                <div class="action-card-icon">prefixe</div>
                <div class="action-card-label">Préfixes</div>
                <div class="action-card-desc">Gérer les préfixes téléphoniques</div>
            </a>

            <a href="/type-operation" class="action-card">
                <div class="action-card-icon">⚙</div>
                <div class="action-card-label">Types d'opération</div>
                <div class="action-card-desc">Définir les types de transactions</div>
            </a>

            <a href="/bareme-frais" class="action-card">
                <div class="action-card-icon">%</div>
                <div class="action-card-label">Barème des frais</div>
                <div class="action-card-desc">Configurer les frais par montant</div>
            </a>

            <a href="/operateur-crud" class="action-card">
                <div class="action-card-icon">operator</div>
                <div class="action-card-label">Opérateurs</div>
                <div class="action-card-desc">Gérer les opérateurs</div>
            </a>

            <a href="/operateur/montants-a-envoyer" class="action-card">
                <div class="action-card-icon">$</div>
                <div class="action-card-label">Montants à envoyer</div>
                <div class="action-card-desc">Voir les montants dus aux autres opérateurs</div>
            </a>
        </div>
    </div>
</body>
</html>
