<?php

class UserModel {
    private $bdd;

    public function __construct($servername, $username, $password, $dbname) {
        $this->bdd = new mysqli($servername, $username, $password, $dbname);
        if ($this->bdd->connect_error) {
            die("La connexion à la base de données a échoué : " . $this->bdd->connect_error);
        }
    }

    public function authenticateUser($email, $motdepasse) {
        $requete = "SELECT * FROM utilisateurs WHERE email = ?";
        $stmt = $this->bdd->prepare($requete);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultat = $stmt->get_result();

        if ($resultat->num_rows > 0) {
            $utilisateur = $resultat->fetch_assoc();
            if ($motdepasse === $utilisateur["motdepasse"]) {
                return $utilisateur;
            } else {
                return "Mot de passe incorrect";
            }
        } else {
            return "Adresse email non trouvée";
        }
    }

    public function closeConnection() {
        $this->bdd->close();
    }
}

?>
