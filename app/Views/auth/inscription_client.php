<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Client — VolaAtHome</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="auth-page">
        <div class="auth-card">
            <div class="auth-title">Inscription Client</div>
            <div class="auth-subtitle">Numéro : <?= esc($numero ?? '') ?></div>

            <?php if (!empty($error ?? null)): ?>
                <div class="alert alert-error"><?= esc($error) ?></div>
            <?php endif; ?>

            <form method="POST" action="/client/inscription">
                <?= csrf_field() ?>
                <input type="hidden" name="numero" value="<?= esc($numero ?? '') ?>">

                <div class="form-group">
                    <label>Votre nom</label>
                    <input type="text" name="nom" placeholder="Nom complet" required>
                </div>

                <button type="submit" class="btn btn-primary" style="width:100%;">Créer mon compte</button>
            </form>

            <div class="auth-footer">
                <a href="/">← Retour</a>
            </div>
        </div>
    </div>
</body>
</html>
