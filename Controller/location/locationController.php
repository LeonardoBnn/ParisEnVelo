<?php

    require_once "../../BDD/bdd.php";
    require_once "../../Model/location/modelLocation.php";
    require_once "../../Model/velo/modelVelo.php";
    require_once "../../Model/accessoires/modelLocationAccessoire.php";


    if(isset($_POST['action'])){

        $locationController = new locationController($bdd);

        switch($_POST['action']){
            case 'ajouter':
                $locationController->create();
                break;
            
            case 'supprimer':
                $locationController->delete();
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
            $ok = $this->location->ajouterLocation($_POST['date_debut'], $_POST['date_fin'], $_SESSION['id_utilisateur'], $_POST['id_velo']);

            if($ok == true){

                $this->locationAccessoires->ajouterLocationAccessoire();    
                $this->velo->updateStatutVelo($_POST['statut'], $_POST['id_livre']);
                $_SESSION['flash_message'] = "La Location a été programmé avec succès";
                $_SESSION['flash_type'] = "succes";
                header("Location:https://127.0.0.1/parisenvelo/index.php?page=velo");
            }else{
                $_SESSION['flash_message'] = "La programmation de cette location a échoué.";
                $_SESSION['flash_type'] = "error";
                header("Location:https://127.0.0.1/parisenvelo/index.php?page=velo");
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

            header("Location:https://127.0.0.1/parisenvelo/index.php?page=velo");

        }
    }

?>