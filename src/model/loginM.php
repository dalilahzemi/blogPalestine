<?php

class UserModel {
    private $bdd;

    public function __construct($bdd) {
        $this->bdd = $bdd;
    }

    public function createUser($nom, $prenom, $email, $motdepasse) {
        $requete = $this->bdd->prepare("INSERT INTO utilisateurs (nom, prenom, email, motdepasse) VALUES (?, ?, ?, ?)");
        $requete->execute([$nom, $prenom, $email, $motdepasse]);
        return $requete->rowCount();
    }
}
?>
