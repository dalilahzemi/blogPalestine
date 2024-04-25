<?php
include '../model/signupM.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost"; // Adresse du serveur MySQL
    $username = "root"; // Nom d'utilisateur MySQL
    $password = ""; // Mot de passe MySQL
    $dbname = "blogs"; // Nom de la base de données
    
    $userModel = new UserModel($servername, $username, $password, $dbname);

    $email = $_POST["email"];
    $motdepasse = $_POST["motdepasse"];

    $authResult = $userModel->authenticateUser($email, $motdepasse);

    if (is_array($authResult)) {
        $_SESSION['utilisateur'] = $authResult;
        header("Location: blogsV.php");
        exit;
    } else {
        $erreur = $authResult;
    }

    $userModel->closeConnection();
}

?>
