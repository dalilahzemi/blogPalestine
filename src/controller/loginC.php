<?php
include '../model/loginM.php';
include '../model/db.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connexion à la base de données
    $bdd = new PDO('mysql:host=localhost;dbname=blogs', 'root', '');

    // Classe pour gérer les opérations CRUD sur les utilisateurs
    $userModel = new UserModel($bdd);

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $motdepasse = $_POST['motdepasse'];

    $resultat = $userModel->createUser($nom, $prenom, $email, $motdepasse);

    if ($resultat) {
        $message = "Utilisateur créé avec succès.";
    } else {
        $message = "Erreur lors de la création de l'utilisateur.";
    }
}


?>
