<?php
    // Vérifie bien tes chemins d'inclusion selon ton arborescence
    require_once "Controller/location/allDeparts.php";
    require_once "Controller/location/allEncours.php";
    require_once "Controller/location/allRetards.php";
?>

<link rel="stylesheet" href="css/dashboard.css">

<main class="main-content">

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
    
    <div class="dashboard-container">

        <?php if (!empty($allRetard)): ?>
            <div class="alert-royal alert-error" style="margin-bottom: 30px;">
                <div class="alert-icon">
                    <svg style="width:28px;height:28px" viewBox="0 0 24 24"><path fill="currentColor" d="M13,14H11V10H13M13,18H11V16H13M1,21H23L12,2L1,21Z" /></svg>
                </div>
                <div class="alert-content">
                    <strong>Attention : <?php echo count($allRetard); ?> location(s) en retard</strong>
                    <ul style="margin-top:10px; padding-left:20px; font-size: 1rem;">
                        <?php foreach ($allRetard as $retard): ?>
                            <li style="margin-bottom: 5px;">
                                <strong><?php echo htmlspecialchars($retard['nom'] . ' ' . $retard['prenom']); ?></strong> 
                                — <?php echo htmlspecialchars($retard['modele']); ?>
                                <span style="background-color: #fee2e2; color: #991b1b; padding: 2px 8px; border-radius: 4px; font-weight: bold; font-size: 0.9em; margin-left: 10px;">
                                    Retard: <?php echo $retard['jours_retard']; ?>j
                                </span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>


        <div class="dashboard-card">
            <div class="section-header">
                <h2>📅 Départs Prévus</h2>
                <span class="badge-acc" style="background:#dcfce7; color:#166534; font-size: 1rem;">
                    <?php echo isset($allDeparts) ? count($allDeparts) : 0; ?> à préparer
                </span>
            </div>

            <?php if (empty($allDeparts)): ?>
                <p style="padding: 20px; text-align: center; color: var(--color-text-muted); font-size: 1.1rem;">
                    Aucun départ prévu pour aujourd'hui ou demain. Tout est calme ! ☕
                </p>
            <?php else: ?>
                <table class="dashboard-table">
                    <thead>
                        <tr>
                            <th width="10%">Date</th>
                            <th width="20%">Client</th>
                            <th width="25%">Vélo & Série</th>
                            <th width="20%">Accessoires</th>
                            <th width="10%">Total</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($allDeparts as $depart): ?>
                        <tr>
                            <td>
                                <span style="color:var(--color-text-muted);">
                                    <?php echo date('d/m', strtotime($depart['date_debut'])); ?>
                                </span>
                            </td>
                            
                            <td>
                                <strong style="font-size: 1.05rem;"><?php echo htmlspecialchars($depart['prenom'] . ' ' . $depart['nom']); ?></strong>
                                <div style="margin-top: 4px;">
                                    <a href="tel:<?php echo htmlspecialchars($depart['telephone']); ?>" style="color:var(--color-text-muted); text-decoration:none; font-size: 0.95rem;">
                                        📞 <?php echo htmlspecialchars($depart['telephone'] ?? '--'); ?>
                                    </a>
                                </div>
                            </td>
                            
                            <td>
                                <span style="font-weight:600; color:var(--color-primary);">
                                    <?php echo htmlspecialchars($depart['modele']); ?>
                                </span>
                                <br>
                                <small style="background:#f3f4f6; padding: 2px 6px; border-radius:4px; color:#6b7280; font-family:monospace;">
                                    <?php echo htmlspecialchars($depart['numero_serie'] ?? 'N/A'); ?>
                                </small>
                            </td>

                            <td>
                                <?php if (!empty($depart['liste_accessoires'])): ?>
                                    <?php 
                                        $accs = explode(',', $depart['liste_accessoires']);
                                        foreach($accs as $acc): 
                                    ?>
                                        <span class="badge-acc"><?php echo trim(htmlspecialchars($acc)); ?></span><br>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <span style="color:#9ca3af; font-style:italic;">Aucun</span>
                                <?php endif; ?>
                            </td>

                            <td class="price-tag">
                                <?php echo number_format($depart['montant_total'], 2, ',', ' '); ?> €
                            </td>

                            <td>
                                <form action="Controller/location/locationController.php" method="POST">
                                    <input type="hidden" name="id_location" value="<?= $depart['id_location'] ?>">
                                    <input type="hidden" name="encours" value="1">
                                    <input type="hidden" name="action" value="encours">
                                    <button class="btn-primary btn-table-action">
                                        Sortir le vélo
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>


        <div class="dashboard-card">
            <div class="section-header">
                <h2 style="color: var(--color-text-muted);">🚲 En Circulation</h2>
                <span style="color: var(--color-text-muted); font-size: 1rem;">
                    <?php echo isset($allEncours) ? count($allEncours) : 0; ?> vélos dehors
                </span>
            </div>

            <?php if (empty($allEncours)): ?>
                <p style="padding: 20px; text-align: center; color: var(--color-text-muted);">
                    Aucun vélo n'est actuellement dehors.
                </p>
            <?php else: ?>
                <table class="dashboard-table">
                    <thead>
                        <tr>
                            <th>Retour Prévu</th>
                            <th>Client</th>
                            <th>Vélo</th>
                            <th>Total Facturé</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($allEncours as $location): ?>
                        <tr>
                            <td>
                                <?php 
                                    $dateRetour = strtotime($location['date_fin_prevue']);
                                    $aujourdhui = strtotime(date('Y-m-d'));
                                    
                                    if ($dateRetour == $aujourdhui) {
                                        echo "<span style='color:var(--color-accent); font-weight:800; font-size:1.1rem;'>Aujourd'hui</span>";
                                    } else {
                                        echo date('d/m/Y', $dateRetour);
                                    }
                                ?>
                            </td>

                            <td>
                                <strong><?php echo htmlspecialchars($location['prenom'] . ' ' . $location['nom']); ?></strong><br>
                                <span style="color:var(--color-text-muted);"><?php echo htmlspecialchars($location['telephone']); ?></span>
                            </td>

                            <td><?php echo htmlspecialchars($location['modele']); ?></td>

                            <td class="price-tag" style="font-size: 1rem; color: var(--color-text-main);">
                                <?php echo number_format($location['montant_total'], 2, ',', ' '); ?> €
                            </td>

                            <td>
                                <form action="Controller/location/locationController.php" method="POST">
                                    <input type="hidden" name="id_location" value="<?= $location['id_location'] ?>">
                                    <input type="hidden" name="encours" value="0">
                                    <input type="hidden" name="action" value="retourVelo">
                                    <button class="btn-outline btn-table-action">
                                        Retour Vélo
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

    </div>
</main>