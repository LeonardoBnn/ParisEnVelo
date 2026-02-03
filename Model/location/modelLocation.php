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

    public function readLocationsRetard(){
        $req = $this->bdd->prepare("SELECT 
                                        l.id_location,
                                        u.nom, u.prenom, u.telephone,
                                        v.modele, v.numero_serie,
                                        l.date_fin_prevue,
                                        DATEDIFF(CURRENT_DATE, l.date_fin_prevue) AS jours_retard
                                    FROM Locations l
                                    JOIN Utilisateurs u ON l.id_client = u.id_utilisateur
                                    JOIN Velos v ON l.id_velo = v.id_velo
                                    WHERE l.date_retour_reelle IS NULL 
                                    AND l.date_fin_prevue < CURRENT_DATE
                                    ");
        $req->execute();

        return $req->fetchAll();
    }

    public function readLocationsDeparts(){
        $req = $this->bdd->prepare("SELECT 
                                        l.id_location,
                                        l.date_debut,
                                        u.nom, u.prenom, u.telephone,
                                        v.modele, v.numero_serie,
                                        -- Calcul du nombre de jours (min 1 jour)
                                        (DATEDIFF(l.date_fin_prevue, l.date_debut) + 1) AS duree_jours,
                                        -- Calcul complexe du Prix Total : (Prix Vélo + Somme Accessoires) * Jours
                                        (
                                            v.prix_journalier + 
                                            COALESCE((SELECT SUM(a.prix_journalier * la.quantite) 
                                                    FROM Location_Accessoires la 
                                                    JOIN Accessoires a ON la.id_accessoire = a.id_accessoire 
                                                    WHERE la.id_location = l.id_location), 0)
                                        ) * (DATEDIFF(l.date_fin_prevue, l.date_debut) + 1) AS montant_total,
                                        (SELECT GROUP_CONCAT(CONCAT(a.nom_accessoire, ' (', la.quantite, ')') SEPARATOR ', ')
                                        FROM Location_Accessoires la
                                        JOIN Accessoires a ON la.id_accessoire = a.id_accessoire
                                        WHERE la.id_location = l.id_location) AS liste_accessoires
                                    FROM Locations l
                                    JOIN Utilisateurs u ON l.id_client = u.id_utilisateur
                                    JOIN Velos v ON l.id_velo = v.id_velo
                                    WHERE l.date_debut BETWEEN CURRENT_DATE AND (CURRENT_DATE + INTERVAL 1 DAY)
                                    AND l.date_retour_reelle IS NULL
                                    AND l.encours IS FALSE -- Pas encore revenu (donc à partir ou en cours de départ)
                                    ORDER BY l.date_debut ASC
                                    ");
        $req->execute();

        return $req->fetchAll();
    }

    public function readLocationsEnCours(){
        $req = $this->bdd->prepare("SELECT 
                                        l.id_location,
                                        l.date_fin_prevue,
                                        u.nom, u.prenom, u.telephone,
                                        v.modele,
                                        (
                                            v.prix_journalier + 
                                            COALESCE((SELECT SUM(a.prix_journalier * la.quantite) 
                                                    FROM Location_Accessoires la 
                                                    JOIN Accessoires a ON la.id_accessoire = a.id_accessoire 
                                                    WHERE la.id_location = l.id_location), 0)
                                        ) * (DATEDIFF(l.date_fin_prevue, l.date_debut) + 1) AS montant_total
                                    FROM Locations l
                                    JOIN Utilisateurs u ON l.id_client = u.id_utilisateur
                                    JOIN Velos v ON l.id_velo = v.id_velo
                                    WHERE l.date_debut <= CURRENT_DATE 
                                    AND l.date_fin_prevue >= CURRENT_DATE
                                    AND l.date_retour_reelle IS NULL
                                    ORDER BY l.date_fin_prevue ASC
                                    ");
        $req->execute();

        return $req->fetchAll();
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

    public function updateStatutLocation($encours, $id_location){

        $req = $this->bdd->prepare("UPDATE Locations SET encours = :encours, date_debut = CURRENT_DATE WHERE id_location = :id_location");

        $req->bindParam(':encours', $encours);
        $req->bindParam(':id_location', $id_location);

        return $req->execute();
    }

    public function retourVelo($encours, $id_location){

        $req = $this->bdd->prepare("UPDATE Locations SET encours = :encours, date_retour_reelle = CURRENT_DATE WHERE id_location = :id_location");

        $req->bindParam(':encours', $encours);
        $req->bindParam(':id_location', $id_location);

        return $req->execute();
    }
}

?>