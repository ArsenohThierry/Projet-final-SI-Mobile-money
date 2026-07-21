<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Client — VolaAtHome</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <!-- Topbar -->
    <div class="topbar">
        <a href="/dashboard" class="topbar-brand">VolaAtHome</a>
        <div class="topbar-nav">
            <span style="color:var(--gray-500);font-size:0.85rem;"><?= esc($client['nom']) ?></span>
            <a href="/client/logout" class="btn-logout">Déconnexion</a>
        </div>
    </div>

    <div class="page">
        <!-- Solde -->
        <div class="stats-grid">
            <div class="card">
                <div class="card-title">Solde disponible</div>
                <div class="card-value"><?= number_format($solde, 0, ',', ' ') ?> Ar</div>
            </div>
        </div>

        <!-- Actions -->
        <div class="page-header">
            <h2>Transactions</h2>
        </div>

        <div class="actions-grid">
            <a href="/depot" class="action-card">
                <div class="action-card-icon">＋</div>
                <div class="action-card-label">Dépôt</div>
                <div class="action-card-desc">Créditer votre compte</div>
            </a>

            <a href="/retrait" class="action-card">
                <div class="action-card-icon">－</div>
                <div class="action-card-label">Retrait</div>
                <div class="action-card-desc">Retirer des fonds</div>
            </a>

            <a href="/transfert" class="action-card">
                <div class="action-card-icon">→</div>
                <div class="action-card-label">Transfert</div>
                <div class="action-card-desc">Envoyer de l'argent</div>
            </a>

            <a href="/historique" class="action-card">
                <div class="action-card-icon">☰</div>
                <div class="action-card-label">Historique</div>
                <div class="action-card-desc">Voir les opérations</div>
            </a>

            <a href="/epargne" class="action-card">
                <div class="action-card-icon">☰</div>
                <div class="action-card-label">Compte épargne</div>
                <div class="action-card-desc">Voir le compte épargne</div>
            </a>
        </div>
    </div>
</body>
</html>