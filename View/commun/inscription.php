<section class="auth-section">
    <div class="auth-card wide-card"> <div class="auth-header">
            <h2>Rejoignez ParisVélo</h2>
            <p>Créez votre compte pour louer en toute liberté.</p>
        </div>
    <?php if (isset($_SESSION['flash_message'])){ ?>
        <?php 
            $isSuccess = ($_SESSION['flash_type'] == 'success');
            $colorVar = $isSuccess ? 'var(--color-success)' : 'var(--color-error)';
            $bgColor = $isSuccess ? '#d4edda' : '#fadbd8';
            $iconClass = $isSuccess ? 'fa-check' : 'fa-triangle-exclamation';
        ?>
        <div class="alert-royal" style="border-left-color: <?= $colorVar ?>;">
            <div class="alert-icon" style="color: <?= $colorVar ?>; background-color: <?= $bgColor ?>;">
                <i class="fa-solid <?= $iconClass ?>"></i>
            </div>
            <div class="alert-content">
                <strong>Information</strong>
                <p><?= $_SESSION['flash_message']; ?></p>
            </div>
        </div>
        <?php unset($_SESSION['flash_message'], $_SESSION['flash_type']); ?>
    <?php } ?>
    
        <form action="Controller/utilisateur/controllerUtilisateur.php" method="POST" class="auth-form">
            
            <div class="form-row">
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" id="prenom" name="prenom" placeholder="Jean" required>
                </div>
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" placeholder="Dupont" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="jean@mail.com" required>
                </div>
                <div class="form-group">
                    <label for="telephone">Téléphone</label>
                    <input type="tel" id="telephone" name="tel" placeholder="06 12 34 56 78" required>
                </div>
            </div>

            <div class="form-group">
                <label for="adresse">Adresse complète</label>
                <input type="text" id="adresse" name="adresse" placeholder="12 Rue de Rivoli, 75004 Paris" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="mdp" placeholder="••••••••" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirmation</label>
                    <input type="password" id="confirm_password" name="confirm_mdp" placeholder="••••••••" required>
                </div>
            </div>
            <small class="form-hint" style="margin-top: -10px; margin-bottom: 10px;">8 caractères minimum.</small>

            <div class="form-check">    
                <input type="checkbox" id="cgu" name="cgu" required>
                <label for="cgu">J'accepte les <a href="index.php?page=CG">CGU & CGV</a></label>
            </div>

            <input type="hidden" name="id_role" value="3">
            <input type="hidden" name="action" value="inscription">
            <button type="submit" class="btn-submit">S'inscrire</button>
        </form>

        <div class="auth-footer">
            <p>Déjà client ? <a href="index.php?page=connexion">Se connecter</a></p>
        </div>

    </div>
</section>