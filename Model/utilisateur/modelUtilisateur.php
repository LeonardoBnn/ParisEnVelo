<?php

class Utilisateur{

    private $bdd;

    function __construct($bdd)
    {
        $this->bdd=$bdd;
    }

    
    public function createUtilisateur($nom, $prenom, $email, $mdp, $tel, $adresse, $role,){

        $hashmdp = sha1($mdp);
        $req = $this->bdd->prepare("INSERT INTO utilisateurs(nom, prenom, email, mdp, telephone, adresse, id_role) VALUES (:nom, :prenom, :email, :mdp, :tel, :adresse, :role)");
        $req->bindParam(':nom', $nom);
        $req->bindParam(':prenom', $prenom);
        $req->bindParam(':email', $email);
        $req->bindParam(':mdp', $hashmdp);
        $req->bindParam(':tel', $tel);
        $req->bindParam(':adresse', $adresse);
        $req->bindParam(':role', $role);     
               
        return $req->execute();
    }

    public function checkLogin($email, $mdp){
        $hashmdp = sha1($mdp);
        $req = $this->bdd->prepare("SELECT * FROM utilisateurs WHERE email= :email AND mdp= :mdp");
        $req->bindParam(':email', $email);
        $req->bindParam(':mdp', $hashmdp);  
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }


    public function readUtilisateurs(){

        $req = $this->bdd->prepare("SELECT U.id_utilisateur, U.nom, U.prenom, U.email, U.telephone, 
                                    R.libelle as nom_role, 
                                    E.nom_ecole  
                                    FROM Utilisateur U
                                    JOIN Role R ON U.fk_id_role = R.id_role
                                    LEFT JOIN Ecole E ON U.fk_id_ecole = E.id_ecole
                                    ORDER BY U.nom ASC
                                    ");
        $req->execute();

        return $req->fetchAll();
    }

    public function selectAllUtilisateurById($id_utilisateur) {

        $req = $this->bdd->prepare("SELECT U.*, R.libelle as nom_role, E.nom_ecole 
                FROM Utilisateur U
                JOIN Role R ON U.fk_id_role = R.id_role
                LEFT JOIN Ecole E ON U.fk_id_ecole = E.id_ecole
                WHERE U.id_utilisateur = :id");
        $req->bindParam(':id', $id_utilisateur);
        $req->execute();

        return $req->fetch(PDO::FETCH_ASSOC);
    }

    /*public function updateUtilisateur($nom, $prenom, $email, $tel, $date_naissance, $id_utilisateur){

        $req = $this->bdd->prepare("UPDATE Utilisateur SET nom = :nom, prenom = :prenom, email= :email, telephone = :tel, date_naissance = :date_naissance WHERE id_utilisateur = :id_utilisateur");
        $req->bindParam(':nom', $nom);
        $req->bindParam(':prenom', $prenom);
        $req->bindParam(':email', $email);
        $req->bindParam(':tel', $tel);
        $req->bindParam(':date_naissance', $date_naissance);
        $req->bindParam(':id_utilisateur', $id_utilisateur);

        return $req->execute();
    }*/

    public function deleteUtilisateur($id_utilisateur){

        $req = $this->bdd->prepare("DELETE FROM Utilisateur WHERE id_utilisateur = :id_utilisateur");
        $req->bindParam(':id_utilisateur', $id_utilisateur);

        return $req->execute();
    }

}