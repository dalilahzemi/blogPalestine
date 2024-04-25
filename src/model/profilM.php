<?php
include 'db.php';

function getArticles($conn, $id_user) {
    $sql = "SELECT * FROM article WHERE id_user=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_user);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}


function addArticle($titre, $contenu, $chemin_image, $id_user) {
    global $conn;
    $sql = "INSERT INTO article (titre, contenu, chemin_image, id_user) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $titre, $contenu, $chemin_image, $id_user);
    return $stmt->execute();
}

function deleteArticle($id_article) {
    global $conn;
    $sql = "DELETE FROM article WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_article);
    return $stmt->execute();
}

function updateArticle($id_article, $titre, $contenu, $chemin_image) {
    global $conn;
    $sql = "UPDATE article SET titre=?, contenu=?, chemin_image=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $titre, $contenu, $chemin_image, $id_article);
    return $stmt->execute();
}

function getUserInfo($conn, $user_id) {
    // Votre requête SQL pour récupérer les informations de l'utilisateur
    $query = "SELECT nom, prenom FROM utilisateurs WHERE id = $user_id";
    $result = mysqli_query($conn, $query);
    $userInfo = mysqli_fetch_assoc($result); // Récupère les informations sous forme de tableau associatif
    return $userInfo['nom'] . ' ' . $userInfo['prenom']; // Renvoie le nom complet de l'utilisateur
}
?>
