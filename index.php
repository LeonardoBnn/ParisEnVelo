<?php

session_start();

require_once "View/commun/header.php";

$page = isset($_GET['page']) ? $_GET['page'] : 'accueil';

switch($page){

    case 'accueil':
        require_once "View/commun/accueil.php";
        break;
    case 'connexion';
        require_once "View/utilisateur/connexion.php";
        break;
    case 'inscription';
        require_once "View/utilisateur/inscription.php";
        break;
    case 'profil';
        require_once "View/utilisateur/profil.php";
        break;
    case 'catalogue';
        require_once "View/client/catalogue.php";
        break;
    case 'pretsClient';
        require_once "View/client/pretsClient.php";
        break;
    case 'reservation';
        require_once "View/client/reservation.php";
        break;
    case 'mentions';
        require_once "View/commun/mentionslegales.php";
        break;
    case 'modifLivre';
        require_once "View/admin/modifLivre.php";
        break;
    case 'ajoutUtilisateur';
        require_once "View/admin/ajoutUtilisateur.php";
        break;
    case 'gestionPrets';
        require_once "View/admin/gestionPrets.php";
        break;
    case 'ajoutLivre';
        require_once "View/admin/ajoutLivre.php";
        break;

    default:
        require_once "View/commun/accueil.php";
        break;
        
    case 'deconnexion':
        session_destroy();
        header('Location:https://127.0.0.1/geolivres/index.php?page=accueil');
        break;

}
require_once "View/commun/footer.php";

?>