<?php
session_start();
include '../model/blogsM.php';
include '../model/db.php';


$articleModel = new Article($conn);

// Vérifier si l'utilisateur est connecté
if(isset($_SESSION['utilisateur'])) {
    $utilisateur = $_SESSION['utilisateur'];
    $nom = $utilisateur['nom'];
    $prenom = $utilisateur['prenom'];
} else {
    // Redirection vers la page de connexion
    header("Location: login.php");
    exit;
}

// Récupération des articles
$articles = $articleModel->getArticles();

$conn->close();

?>
