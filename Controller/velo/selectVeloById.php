<?php

require_once "BDD/bdd.php";
require_once "Model/velo/modelVelo.php";

$veloController = new Velo($bdd);

$velo = $veloController->selectVeloByID($_GET['id_velo']);
?>