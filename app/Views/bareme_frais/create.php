<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un barème — VolaAtHome</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="topbar">
        <a href="/operateur/dashboard" class="topbar-brand">VolaAtHome</a>
        <div class="topbar-nav">
            <a href="/operateur/logout" class="btn-logout">Déconnexion</a>
        </div>
    </div>

    <div class="page page--narrow">
        <a href="/bareme-frais" class="back-link">Barème des frais</a>

        <div class="card">
            <div class="page-header" style="margin-bottom:1.5rem;">
                <h1 style="font-size:1.25rem;">Ajouter un barème</h1>
            </div>

            <form method="POST" action="/bareme-frais/store">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label>Type d'opération</label>
                    <select name="id_type_operation" required>
                        <option value="">— Choisir —</option>
                        <?php foreach ($types as $t): ?>
                            <option value="<?= $t->id ?>"><?= esc($t->libelle) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Montant minimum</label>
                    <input type="number" step="0.01" name="montant_min" required>
                </div>

                <div class="form-group">
                    <label>Montant maximum</label>
                    <input type="number" step="0.01" name="montant_max" required>
                </div>

                <div class="form-group">
                    <label>Frais</label>
                    <input type="number" step="0.01" name="frais" required>
                </div>

                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
        </div>
    </div>
</body>
</html>
