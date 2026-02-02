<?php

class Accessoire{

    private $bdd;

    function __construct($bdd)
    {
        $this->bdd = $bdd;
    }

    public function selectAllAccessoires(){

        $req = $this->bdd->prepare("SELECT * FROM accessoires");
        $req->execute();

        return $req->fetchAll();
    }
    
}

?>