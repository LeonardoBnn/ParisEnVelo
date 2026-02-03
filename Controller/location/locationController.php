<?php

    session_start();

    require_once "../../BDD/bdd.php";
    require_once "../../Model/location/modelLocation.php";
    require_once "../../Model/velo/modelVelo.php";
    require_once "../../Model/location_accessoire/modelLocationAccessoire.php";


    if(isset($_POST['action'])){

        $locationController = new locationController($bdd);

        switch($_POST['action']){
            case 'ajouter':
                $locationController->create();
                break;
            
            case 'supprimer':
                $locationController->delete();
                break;

            case 'encours':
                $locationController->updateStatutLocation();
                break;

            case 'retourVelo':
                $locationController->retourVelo();
                break;
        }
    }



    class locationController{

        private $location, $velo, $locationAccessoires;

        function __construct($bdd){
            $this->location = new Location($bdd);
            $this->velo = new Velo($bdd);
            $this->locationAccessoires = new LocationAccessoire($bdd);
        }

        public function create(){
            $id_location = $this->location->ajouterLocation($_POST['date_debut'], $_POST['date_fin'], $_POST['id_utilisateur'], $_POST['id_velo']);

            if($id_location != null){
                
                $ok = $this->locationAccessoires->ajouterLocationAccessoire($id_location, $_POST['accessoires']);
                
                if($ok == true){
                    $this->velo->updateStatutVelo($_POST['statut'], $_POST['id_velo']);
                    $_SESSION['flash_message'] = "La Location a été programmé avec succès";
                    $_SESSION['flash_type'] = "succes";
                    header("Location:https://127.0.0.1/parisenvelo/index.php?page=velos");
                }else{
                    $_SESSION['flash_message'] = "La programmation de cette location a échoué.";
                    $_SESSION['flash_type'] = "error";
                    header("Location:https://127.0.0.1/parisenvelo/index.php?page=velos");
                }
            }
        }

        public function delete(){

            $ok = $this->location->supprimerlocation($_POST['id_location']);

            if($ok == true){
    
                $_SESSION['flash_message'] = "La Location a été supprimée avec succès !";
                $_SESSION['flash_type'] = "succes";
            }else{
                $_SESSION['flash_message'] = "La suppression de cette Location a échoué.";
                $_SESSION['flash_type'] = "error";
            }

            header("Location:https://127.0.0.1/parisenvelo/index.php?page=listeVelos");

        }

        public function updateStatutLocation(){

            $ok = $this->location->updateStatutLocation($_POST['encours'], $_POST['id_location']);

            if($ok == true){
    
                $_SESSION['flash_message'] = "La Location a demarré avec succès !";
                $_SESSION['flash_type'] = "succes";

            }else{
                $_SESSION['flash_message'] = "La Location n'a pas pu démarrer.";
                $_SESSION['flash_type'] = "error";
            }

             header("Location:https://127.0.0.1/parisenvelo/index.php?page=accueilVendeur");
        }

        public function retourVelo(){

            $ok = $this->location->retourVelo($_POST['encours'], $_POST['id_location']);

            if($ok == true){
    
                $_SESSION['flash_message'] = "La Location est terminée !";
                $_SESSION['flash_type'] = "succes";

            }else{
                $_SESSION['flash_message'] = "La Location n'a pas pu terminer.";
                $_SESSION['flash_type'] = "error";
            }

             header("Location:https://127.0.0.1/parisenvelo/index.php?page=accueilVendeur");
        }
    }

?>