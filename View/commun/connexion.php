

<section class="login-wrapper">
    <div class="login-box">
        
        <div class="login-header">
            <h2 class="login-title">Bon retour !</h2>
            <p class="login-subtitle">Connectez-vous pour accéder à votre espace.</p>
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
    
        <form action="Controller/utilisateur/controllerUtilisateur.php" method="POST" class="login-form">
            
            <div class="login-field">
                <label for="email" class="login-label">Adresse Email</label>
                <div class="login-input-wrap">
                    <input type="email" id="email" name="email" class="login-input" placeholder="jean@mail.com" required autofocus>
                </div>
            </div>

            <div class="login-field">
                <label for="mdp" class="login-label">Mot de passe</label>
                <div class="login-input-wrap">
                    <input type="password" id="mdp" name="mdp" class="login-input" placeholder="*********" required>
                </div>
            </div>

            <input type="hidden" name="action" value="connexion">
            <button type="submit" class="login-btn">Se connecter</button>

        </form>

        <div class="login-footer">
            <p>Pas encore de compte ? <a href="index.php?page=inscription" class="login-link">Créer un compte</a></p>
        </div>

    </div>
</section>