
<?php

require_once "BDD/bdd.php";
require_once "Model/velo/modelVelo.php";

$veloController = new Velo($bdd);

if (isset($_POST['action']) && !empty($_POST['id_categorie'])) {
    $categorieSelectionnee = $_POST['id_categorie'];
    $allVelos = $veloController->selectVeloByStatutAndCategorie($categorieSelectionnee);
} else {
    // Par défaut (arrivée sur la page), on affiche tout ce qui est "En rayon"
    $allVelos = $veloController->selectVeloByStatutAndCategorie(null);
}
?>