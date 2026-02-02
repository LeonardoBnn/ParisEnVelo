<?php 

class Velo{

    private $bdd;

    function __construct($bdd)
    {
        $this->bdd = $bdd;
    }

    public function ajouterVelo($modele, $numero_serie, $est_electrique, $prix, $statut, $categorie){

        $req = $this->bdd->prepare("INSERT INTO Livre(modele, numero_serie, est_electrique, prix_journalier, statut, id_categorie)
                                               VALUES(:modele, :numero_serie, :est_electrique, :prix, :statut, :categorie)");
        
        $req->bindParam(':modele', $modele);
        $req->bindParam(':numero_serie', $numero_serie);
        $req->bindParam(':est_electrique', $est_electrique);
        $req->bindParam(':prix', $prix);  
        $req->bindParam(':statut', $statut);  
        $req->bindParam(':categorie', $categorie);

        return $req->execute();;

    }

    public function selectVelosByNumSerie($numero_serie){

        $req = $this->bdd->prepare("SELECT * FROM velos WHERE numero_serie = :numero_serie");
        
        $req->bindParam(':numero_serie', $numero_serie);
        
        $req->execute();

        return $req->fetch();
    }

    public function selectAllVelos(){
        $req = $this->bdd->prepare("SELECT * FROM velos");
        $req->execute();

        return $req->fetchAll();
    }

    public function selectVeloByStatutAndCategorie($id_categorie){
        $sql = "SELECT V.id_velo, V.modele, V.numero_serie, V.est_electrique, V.prix_journalier, V.statut, C.libelle
                FROM velos V
                JOIN categories C ON V.id_categorie = C.id_categorie
                WHERE V.statut = 'disponible'
                ";

        if ($id_categorie != null) {
            $sql .= " AND V.id_categorie = :id_categorie";
        }
        
        $req = $this->bdd->prepare($sql);
        
        if ($id_categorie != null) {
            $req->bindParam(':id_categorie', $id_categorie);
        }

        $req->execute();
        return $req->fetchAll();
    }

    public function selectVeloByID($id_velo){

        $req = $this->bdd->prepare("SELECT * FROM velos WHERE id_velo = :id_velo");
        
        $req->bindParam(':id_velo', $id_velo);
        
        $req->execute();

        return $req->fetch();
    }

    public function updateStatutVelo($statut, $id_velo){

        $req = $this->bdd->prepare("UPDATE velos SET statut = :statut WHERE id_velo = :id_velo");

        $req->bindParam(':id_velo', $id_velo);
        $req->bindParam(':statut', $statut);

        return $req->execute();
    }

    public function updateLivre($id_velo, $modele, $numero_serie, $est_electrique, $prix, $statut, $categorie){

        $req = $this->bdd->prepare("UPDATE velos SET modele = :modele, numero_serie = :numero_serie, est_electrique = :est_electrique, prix_journalier = :prix, statut = :statut id_categorie = :categorie  WHERE id_velo = :id_velo");

        $req->bindParam(':id_velo', $id_velo);
        $req->bindParam(':modele', $modele);
        $req->bindParam(':numero_serie', $numero_serie);
        $req->bindParam(':est_electrique', $est_electrique);
        $req->bindParam(':prix', $prix);
        $req->bindParam(':statut', $statut);
        $req->bindParam(':categorie', $categorie);

        return $req->execute();
    }

    public function deleteVelo($id_velo){

        $req = $this->bdd->prepare("DELETE FROM velos WHERE id_velo = :id_velo");

        $req->bindParam(':id_velo', $id_velo);
        return $req->execute();
    }


}

?>