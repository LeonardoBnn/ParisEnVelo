<?php
require_once "Controller/velo/selectVeloById.php";
require_once "Controller/accessoires/selectAllAccessoires.php";

?>

<section class="main-content">
    
    <div class="reservation-container">
        
        <aside>
            
            <div class="bike-card"> <div class="bike-card-header">
                    <span>🚲</span>
                    <?php if ($velo['est_electrique']): ?>
                        <span class="bike-badge">⚡ Électrique</span>
                    <?php endif; ?>
                </div>
                <div class="bike-card-body">
                    <span class="bike-category">Vélo sélectionné</span>
                    <h3 class="bike-title"><?= htmlspecialchars($velo['modele']) ?></h3>
                    <div class="bike-price">
                        <?= number_format($velo['prix_journalier'], 2, ',', ' ') ?>€
                        <span>/jour</span>
                    </div>
                </div>
            </div>

            <div class="alert-royal" style="margin-top: 20px;">
                <div class="alert-icon">ℹ️</div>
                <div class="alert-content">
                    <strong>Information</strong>
                    <p>Une caution pourra être demandée lors du retrait du vélo en magasin.</p>
                </div>
            </div>
        </aside>

        <main>
            <h1 style="color: var(--color-primary); margin-bottom: var(--spacing-md);">Finaliser la réservation</h1>
            
            <form action="Controller/location/locationController.php" method="POST">
                
                <input type="hidden" name="id_velo" value="<?= $velo['id_velo'] ?>">

                <div style="display: flex; gap: var(--spacing-md); flex-wrap: wrap;">
                    <div class="form-group" style="flex: 1;">
                        <label for="date_debut" class="form-label">Début de location</label>
                        <input type="date" id="date_debut" name="date_debut" class="form-input" required>
                    </div>
                    
                    <div class="form-group" style="flex: 1;">
                        <label for="date_fin" class="form-label">Fin prévue</label>
                        <input type="date" id="date_fin" name="date_fin" class="form-input" required>
                    </div>
                </div>

                <h3 style="color: var(--color-primary); margin-bottom: var(--spacing-sm); margin-top: var(--spacing-md);">
                    Accessoires recommandés
                </h3>
                <p style="font-size: var(--font-size-sm); color: var(--color-text-muted); margin-bottom: var(--spacing-sm);">
                    Ajoutez des équipements pour plus de sécurité et de confort.
                </p>

                <div class="accessories-list">
                    <?php foreach ($allAccessoires as $acc): ?>
                        <div class="accessory-item">
                            <div class="accessory-info">
                                <h4><?= htmlspecialchars($acc['nom_accessoire']) ?></h4>
                                <span class="accessory-price">
                                    +<?= number_format($acc['prix_journalier'], 2, ',', ' ') ?>€ /jour
                                </span>
                            </div>
                            
                            <div class="accessory-action">
                                <label for="acc_<?= $acc['id_accessoire'] ?>" style="font-size: 0.8rem; margin-right: 5px;">Qté</label>
                                <input type="number" 
                                       id="acc_<?= $acc['id_accessoire'] ?>" 
                                       name="accessoires[<?= $acc['id_accessoire'] ?>]" 
                                       class="form-input qty-input" 
                                       min="0" 
                                       max="5" 
                                       value="0">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                
                <input type="hidden" name="statut" value="emprunté">
                <input type="hidden" name="action" value="ajouter">
                <input type="hidden" name="id_utilisateur" value="<?php echo $_SESSION['user']['id_utilisateur'] ?>">

                <div style="text-align: right; margin-top: var(--spacing-lg);">
                    <button type="submit" class="btn-primary" style="padding: 1rem 2rem; font-size: 1rem;">
                        Confirmer la demande
                    </button>
                </div>

            </form>
        </main>
    </div>
</section>