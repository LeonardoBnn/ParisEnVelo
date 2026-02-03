<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/8419f108ca.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="Public/styles/rootstyle.css">
    <link rel="stylesheet" href="Public/styles/header.css">
    <link rel="stylesheet" href="Public/styles/footer.css">
    <link rel="stylesheet" href="Public/styles/inscription.css">
    <link rel="stylesheet" href="Public/styles/connexion.css">
    <link rel="stylesheet" href="Public/styles/velos.css">
    <link rel="stylesheet" href="Public/styles/reservation.css">
    <link rel="stylesheet" href="Public/styles/profil.css">
    <link rel="stylesheet" href="Public/styles/CG.css">
    <link rel="stylesheet" href="Public/styles/accueil.css">
    <link rel="stylesheet" href="Public/styles/accueilVendeur.css">


    <title>ParisEnVélos</title>
</head>
<body>
<?php
//var_dump($_SESSION['user']);
//die(); 
?>

    <header id="main-header" class="site-header">
  
        <div class="header-logo">
            <a href="#" class="logo-text">ParisVélo</a>
        </div>
        <?php if(!empty($_SESSION['user'])){?>
            <nav class="header-nav">
                <ul class="nav-list">
                <?php if($_SESSION['user']['id_role'] == 1): ?> <!-- admin -->
                    <li><a href="index.php?page=" class="nav-link">Gestion vélos</a></li>
                    <li><a href="index.php?page=" class="nav-link">Gestion clients</a></li>
                    <li><a href="index.php?page=" class="nav-link"></a></li>
                    <li><a href="index.php?page=" class="nav-link"></a></li>
                <?php endif; ?>

                <?php if($_SESSION['user']['id_role'] == 2): ?>  <!-- vendeur -->
                    <li><a href="index.php?page=accueilVendeur" class="nav-link">dashboard</a></li>
                    <li><a href="index.php?page=listeVelos" class="nav-link">Nos Vélos</a></li>
                    <li><a href="index.php?page=" class="nav-link"></a></li>
                    <li><a href="index.php?page=" class="nav-link"></a></li>
                <?php endif; ?>

                <?php if($_SESSION['user']['id_role'] == 3): ?> <!-- client -->
                    
                    <li><a href="index.php?page=accueil" class="nav-link">Accueil</a></li>
                    <li><a href="index.php?page=velos" class="nav-link">Nos vélos</a></li>
                    <li><a href="index.php?page=" class="nav-link"></a></li>
                    <li><a href="index.php?page=" class="nav-link"></a></li>
                <?php endif; ?>
                </ul>
            </nav>

            <div class="header-actions">
                <a href="index.php?page=profil" class="btn-profile" aria-label="Mon Profil">
                    <i class="fa-solid fa-user"></i>
                </a>

                <a href="index.php?page=deconnexion" class="btn-outline">
                    Déconnexion
                </a>
            </div>

        <?php }else{?>    
            <div class="header-actions">
                <a href="index.php?page=connexion" class="btn-link">Connexion</a>
                <a href="index.php?page=inscription" class="btn-primary">Inscription</a>
            </div>
        <?php }?>

    </header>

    <main class="main-content">