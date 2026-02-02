<?php
    require_once "Controller/velo/selectVelosDispoByCategorie.php";
?>


<section class="main-content">
    
    <div style="max-width: 1200px; margin: 0 auto; padding: var(--spacing-md);">
        <h2 style="font-size: var(--font-size-xxl); color: var(--color-primary); margin-bottom: var(--spacing-sm);">
            Nos Vélos Disponibles
        </h2>
        <p style="color: var(--color-text-muted);">
            Choisissez votre monture idéale pour parcourir Paris.
        </p>
    </div>

    <div class="bikes-grid">
        
        <?php 
        // Vérification s'il y a des vélos
        if (isset($allVelos) && count($allVelos) > 0): 
            foreach ($allVelos as $velo): 
                // On affiche uniquement si le statut est 'disponible'
                // (Sécurité supplémentaire même si ta requête SQL le fait déjà)
                if ($velo['statut'] === 'disponible'):
        ?>
            
            <article class="bike-card">
                <div class="bike-card-header">
                    <span>🚲</span>
                    
                    <?php if ($velo['est_electrique']): ?>
                        <span class="bike-badge">⚡ Électrique</span>
                    <?php else: ?>
                        <span class="bike-badge">🦵 Classique</span>
                    <?php endif; ?>
                </div>

                <div class="bike-card-body">
                    <span class="bike-category">
                        <?= htmlspecialchars($velo['libelle'] ?? 'Vélo') ?>
                    </span>
                    
                    <h3 class="bike-title">
                        <?= htmlspecialchars($velo['modele']) ?>
                    </h3>
                    
                    <div class="bike-details">
                        <div class="bike-price">
                            <?= number_format($velo['prix_journalier'], 2, ',', ' ') ?>€
                            <span>/jour</span>
                        </div>
                        
                        <a href="index.php?page=reservation&id_velo=<?= $velo['id_velo'] ?>" class="btn-reserve">
                            Réserver
                        </a>
                    </div>
                </div>
            </article>

        <?php 
                endif; 
            endforeach; 
        else: 
        ?>
            <div class="alert-royal alert-error" style="grid-column: 1 / -1;">
                <div class="alert-icon">!</div>
                <div class="alert-content">
                    <strong>Oups !</strong>
                    <p>Aucun vélo n'est disponible pour le moment. Revenez plus tard !</p>
                </div>
            </div>
        <?php endif; ?>

    </div>
</section>