<?php

require_once "BDD/bdd.php";
require_once "Model/accessoires/modelAccessoire.php";

$accessoireController = new Accessoire($bdd);

$allAccessoires = $accessoireController->selectAllAccessoires();
?>