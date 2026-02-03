<?php

require_once "BDD/bdd.php";
require_once "Model/location/modelLocation.php";

$locationController = new Location($bdd);

$allRetard = $locationController->readLocationsRetard();
?>