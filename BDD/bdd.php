<?php 

try{

$user = "root";
$mdp = "";
$bdd = new PDO('mysql:host=localhost;dbname=parisenvelo', $user, $mdp);

}catch(PDOException $e){

    echo "Erreur de connexion : " . $e->getMessage();
    die();
}

?>