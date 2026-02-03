<?php

class LocationAccessoire{

    private $bdd;

    function __construct($bdd) {
        $this->bdd = $bdd;
    }

    public function ajouterLocationAccessoire($id_location, $accessoires){
        foreach($accessoires as $id_accessoire => $quantite){
            $req = $this->bdd->prepare("INSERT INTO location_accessoires(id_location, id_accessoire, quantite) 
                                                    VALUES (:id_location, :id_accessoire, :quantite)");
            
            $req->bindParam(':id_location', $id_location);
            $req->bindParam(':id_accessoire', $id_accessoire);
            $req->bindParam(':quantite', $quantite); 

            $success = $req->execute();
        }

        return $success;
    }

    public function readLocationAccessoires(){

        $req = $this->bdd->prepare("SELECT 
                                        LA.*, 
                                        L.*, 
                                        C.*,
                                        V.* 
                                    FROM Location_accessoires LA
                                    JOIN locations L on LA.id_location = L.id_location
                                    JOIN Utilisateurs C ON L.id_client = C.id_utilisateur
                                    JOIN Velos V ON L.id_velo = V.id_velo
                                    ORDER BY L.date_debut ASC;
                                    ");
        $req->execute();

        return $req->fetchAll();
    }

    public function supprimerlocation($id_location){

        $req = $this->bdd->prepare("DELETE FROM Locations WHERE id_location = :id_location
                                    ");
        
        $req->bindParam(':id_location', $id_location);
        
        $req->execute();

        return $req->fetchAll();
    }
}

?>