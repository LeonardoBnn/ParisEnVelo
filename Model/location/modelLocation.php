<?php

class Location{

    private $bdd;

    function __construct($bdd) {
        $this->bdd = $bdd;
    }

    public function ajouterLocation($date_debut, $date_fin, $id_client, $id_velo){

        $req = $this->bdd->prepare("INSERT INTO locations(date_debut, date_fin_prevue, id_client, id_velo) 
                                                  VALUES (:date_debut, :date_fin, :id_client, :id_velo)");
        
        $req->bindParam(':date_debut', $date_debut);
        $req->bindParam(':date_fin', $date_fin);
        $req->bindParam(':id_client', $id_client);
        $req->bindParam(':id_velo', $id_velo);
        
        $resultat = $req->execute();
    
        if($resultat) {
            return $this->bdd->lastInsertId(); // C'est l'objet PDO qui donne l'ID
        }

        return false;
    }

    public function readLocations(){

        $req = $this->bdd->prepare("SELECT 
                                        L.*, 
                                        C.*, 
                                        V.* 
                                    FROM Locations L
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