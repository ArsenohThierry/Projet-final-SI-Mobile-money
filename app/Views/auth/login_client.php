<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Client — VolaAtHome</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="auth-page">
        <div class="auth-card">
            <div class="auth-title">Connexion Client</div>
            <div class="auth-subtitle">Entrez votre numéro de téléphone</div>

            <?php if (!empty(session()->getFlashdata('error'))): ?>
                <div class="alert alert-error"><?= esc(session()->getFlashdata('error')) ?></div>
            <?php endif; ?>

            <form method="POST" action="/auth/login-client">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label>Numéro de téléphone</label>
                    <input type="text" name="numero" placeholder="Ex: 033 12 345 67" required>
                </div>

                <button type="submit" class="btn btn-primary" style="width:100%;">Se connecter</button>
            </form>

            <div class="auth-footer">
                <a href="/">← Retour</a>
            </div>
        </div>
    </div>
</body>
</html>
