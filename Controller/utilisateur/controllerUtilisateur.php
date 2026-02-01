<?php

require_once "../../BDD/bdd.php";
require_once "../../Model/utilisateur/modelUtilisateur.php";


if(isset($_POST['action'])){

    $utilisateurController = new utilisateurController($bdd);

    switch($_POST['action']){
        
        case 'inscription':
            $utilisateurController->create();
            break;
        
        case 'connexion':
            $utilisateurController->login();
            break;

        case 'suppression':
            $utilisateurController->delete();
            break;
    }
}


class utilisateurController{

    private $utilisateur;

    function __construct($bdd){
        $this->utilisateur = new Utilisateur($bdd);
    }

    public function create(){
        if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if($_POST['mdp'] == $_POST['confirm_mdp']){
    // Appel au modèle pour créer l'user
        $succes = $this->utilisateur->createUtilisateur(
            $_POST['nom'], 
            $_POST['prenom'], 
            $_POST['email'], 
            $_POST['mdp'], 
            $_POST['tel'],
            $_POST['adresse'], 
            $_POST['id_role'],
        );
    }else{
        $_SESSION['flash_message'] = "Les mots de passe doivent correspondre pour continuer !";
        $_SESSION['flash_type'] = "error";
        header("Location: ../../index.php?page=inscription");
        exit();
    }

    if(isset($_POST['source']) && $_POST['source'] == 'admin'){
        if($succes){
            $_SESSION['flash_message'] = "Utilisateur créé avec succès.";
            $_SESSION['flash_type'] = "success";
        } else {
            $_SESSION['flash_message'] = "Erreur lors de la création (Email peut-être déjà pris).";
            $_SESSION['flash_type'] = "error";
        }
    }

    // REDIRECTION INTELLIGENTE
    // Si un champ caché 'source' = 'admin' est présent, on reste dans l'admin
    if (isset($_POST['source']) && $_POST['source'] == 'admin') {
        header("Location: ../../index.php?page=ajoutUtilisateur"); 
    } else {
        // Sinon c'est une inscription publique classique
        header("Location: ../../index.php?page=connexion");
    }
    }

    public function delete(){
        $this->utilisateur->deleteUtilisateur($_POST['id_utilisateur']);

        header("Location:https://127.0.0.1/parisenvelo/index.php?page=ajoutUtilisateur");
    }

    public function login(){

        // 1. On démarre la session AVANT tout, pour pouvoir l'utiliser en succès OU en échec
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $user = $this->utilisateur->checkLogin($_POST['email'], $_POST['mdp']);
        
        if ($user) {
            $_SESSION['user'] = $user;
            header('Location: https://127.0.0.1/parisenvelo/index.php?page=accueil');
            exit;
        } else {
            // Échec : on enregistre le message flash
            $_SESSION['flash_message'] = "Identifiants incorrects.";
            $_SESSION['flash_type'] = "error";
            
            header('Location: https://127.0.0.1/parisenvelo/index.php?page=connexion'); 
            exit;
        }
    }

}

?>