<main class="main-content home-page">

    <section class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">Découvrez Paris en toute liberté</h1>
            <p class="hero-subtitle">
                Des vélos électriques et classiques de qualité pour explorer la Ville Lumière sans limites.
            </p>
            <div class="hero-actions">
                <a href="index.php?page=velos" class="btn-primary btn-hero">Voir nos vélos</a>
                <a href="#how-it-works" class="btn-outline btn-hero-outline">Comment ça marche ?</a>
            </div>
        </div>
    </section>

    <section class="section-container">
        <div class="section-header">
            <h2 class="section-title">Pourquoi choisir parisenvelo ?</h2>
            <p class="section-desc">Nous simplifions votre mobilité urbaine avec un service premium.</p>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h3>Vélos Électriques</h3>
                <p>Montez à Montmartre sans sueur grâce à notre flotte à assistance électrique dernière génération.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <h3>Sécurité Incluse</h3>
                <p>Casque, antivol certifié et assurance inclus dans chaque location pour rouler l'esprit tranquille.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3>Flexibilité Totale</h3>
                <p>Réservez pour une heure ou une semaine. Annulation gratuite jusqu'à 24h avant le départ.</p>
            </div>
        </div>
    </section>
    <?php if(!empty($_SESSION['user'])){ ?>z
        <section class="cta-banner" id="how-it-works">
            <div class="cta-content">
                <h2>Prêt à pédaler ?</h2>
                <p>Réservez votre vélo en 3 clics et récupérez-le à notre agence centrale.</p>
                <a href="index.php?page=velos" class="btn-primary btn-large">Choisir le vélo.</a>
            </div>
        </section>
    <?php }else{ ?>
        <section class="cta-banner" id="how-it-works">
            <div class="cta-content">
                <h2>Prêt à pédaler ?</h2>
                <p>Réservez votre vélo en 3 clics et récupérez-le à notre agence centrale.</p>
                <a href="index.php?page=inscription" class="btn-primary btn-large">Créer un compte</a>
            </div>
        </section>
    <?php  } ?>
</main>