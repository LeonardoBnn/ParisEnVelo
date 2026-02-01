           </main>
       <footer class="site-footer">
            <div class="footer-container">
                
                <div class="footer-section">
                    <h3 class="footer-logo">ParisVélo</h3>
                    <p class="footer-text">
                        La liberté de parcourir Paris, <br>
                        sans les contraintes.
                    </p>
                    <div class="social-links">
                        <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fa-brands fa-twitter"></i></a>
                    </div>
                </div>

                <div class="footer-section">
                    <h4>Explorer</h4>
                    <ul class="footer-links">
                        <li><a href="index.php?page=catalogue">Nos Vélos</a></li>
                        <li><a href="index.php?page=tarifs">Tarifs & Abonnements</a></li>
                        <li><a href="index.php?page=boutiques">Nos Boutiques</a></li>
                        <li><a href="index.php?page=blog">Blog</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4>Informations</h4>
                    <ul class="footer-links">
                        <li><a href="index.php?page=faq">Aide / FAQ</a></li>
                        <li><a href="index.php?page=mentions">Mentions Légales</a></li>
                        <li><a href="index.php?page=cgu">CGU / CGV</a></li>
                        <li><a href="index.php?page=confidentialite">Politique de confidentialité</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h4>Nous trouver</h4>
                    <ul class="contact-info">
                        <li><i class="fa-solid fa-location-dot"></i> 12 Rue de Rivoli, 75004 Paris</li>
                        <li><i class="fa-solid fa-phone"></i> 01 23 45 67 89</li>
                        <li><i class="fa-solid fa-envelope"></i> contact@parisvelo.fr</li>
                        <li><i class="fa-regular fa-clock"></i> 7j/7 - 09h00 à 19h00</li>
                    </ul>
                </div>

            </div>

            <div class="footer-bottom">
                <p>&copy; 2024 ParisVélo. Tous droits réservés.</p>
            </div>
        </footer>


    <script>
        let lastScrollTop = 0;
        const header = document.getElementById('main-header');
        const scrollThreshold = 80; // Ne commence l'effet qu'après 100px de descente

        window.addEventListener('scroll', function() {
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        // Si on est tout en haut de la page, on affiche toujours le header
        if (scrollTop <= 0) {
            header.classList.remove('header-hidden');
            lastScrollTop = 0;
            return;
        }   

        // Logique principale
        if (scrollTop > lastScrollTop && scrollTop > scrollThreshold) {
            // Scroll vers le BAS -> On cache
            header.classList.add('header-hidden');
        } else {
            // Scroll vers le HAUT -> On affiche
            header.classList.remove('header-hidden');
        }
        
        lastScrollTop = scrollTop;
        });
    </script>
</body>
</html>