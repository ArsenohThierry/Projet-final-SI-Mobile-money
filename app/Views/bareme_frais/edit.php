<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le barème — VolaAtHome</title>
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
                <h1 style="font-size:1.25rem;">Modifier le barème</h1>
            </div>

            <form method="POST" action="/bareme-frais/update/<?= $frais->id ?>">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label>Type d'opération</label>
                    <select name="id_type_operation" required>
                        <?php foreach ($types as $t): ?>
                            <option value="<?= $t->id ?>" <?= $frais->id_type_operation == $t->id ? 'selected' : '' ?>><?= esc($t->libelle) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Montant minimum</label>
                    <input type="number" step="0.01" name="montant_min" value="<?= $frais->montant_min ?>" required>
                </div>

                <div class="form-group">
                    <label>Montant maximum</label>
                    <input type="number" step="0.01" name="montant_max" value="<?= $frais->montant_max ?>" required>
                </div>

                <div class="form-group">
                    <label>Frais</label>
                    <input type="number" step="0.01" name="frais" value="<?= $frais->frais ?>" required>
                </div>

                <button type="submit" class="btn btn-primary">Modifier</button>
            </form>
        </div>
    </div>
</body>
</html>
