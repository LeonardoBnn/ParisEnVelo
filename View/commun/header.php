<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/8419f108ca.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="Public/style/styleRoot.css">
    <link rel="stylesheet" href="Public/style/header.css">
    <link rel="stylesheet" href="Public/style/footer.css">
    <link rel="stylesheet" href="Public/style/inscription.css">
    <link rel="stylesheet" href="Public/style/connexion.css">
    <link rel="stylesheet" href="Public/style/tableauClient.css">
    <link rel="stylesheet" href="Public/style/reservation.css">
    <link rel="stylesheet" href="Public/style/profil.css">
    <link rel="stylesheet" href="Public/style/mentionsLegales.css">
    <link rel="stylesheet" href="Public/style/accueil.css">


    <title>ParisEnVélos</title>
</head>
<body>
<?php
//var_dump($_SESSION['user']);
//die(); 
?>

    <header class="main-header">
        <div class="container header-flex">
            <div class="brand">
                <img src="Public/img/logo.png" alt="Logo GéoLivres" class="logo-img">
            </div>
            <?php if(!empty($_SESSION['user'])){?>

            <a href="index.php?page=profil" class="profile-link" title="Mon Profil">
                <span class="profile-icon"><i class="fa-solid fa-user"></i></span> </a>
            
            <a href="index.php?page=deconnexion" class="btn btn-outline">Déconnexion</a>
        <?php }elseif(empty($_SESSION['user'])){?>    
            <div class="header-actions">
                <a href="index.php?page=connexion" class="login-link">Connexion</a>
                <a href="index.php?page=inscription" class="btn btn-primary">Inscription</a>
            </div>

        <?php } ?>
            <div class="mobile-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </header>

    <main>