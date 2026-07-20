<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Opérateur — VolaAtHome</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="auth-page">
        <div class="auth-card">
            <div class="auth-title">Connexion Opérateur</div>
            <div class="auth-subtitle">Accédez à votre tableau de bord</div>

            <?php if (!empty($error ?? null)): ?>
                <div class="alert alert-error"><?= esc($error) ?></div>
            <?php endif; ?>

            <form method="POST" action="/auth/login-operateur">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" placeholder="vous@exemple.com" required>
                </div>

                <div class="form-group">
                    <label>Mot de passe</label>
                    <input type="password" name="password" placeholder="••••••••" required>
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
