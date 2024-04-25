<?php
session_start();

include '../model/profilM.php';
include '../model/db.php';

if(isset($_SESSION['utilisateur'])) {
    $utilisateur = $_SESSION['utilisateur'];
    $id = $utilisateur['id'];
    $nom = $utilisateur['nom'];
    $prenom = $utilisateur['prenom'];
} else {
    header("Location: login.php");
    exit;
}

// Ajout d'un nouvel article
if(isset($_POST['ajouter_article'])) {
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];

    // Gestion du téléchargement d'image
    $dossierDestination = "images/";

    // Vérifier si le répertoire de destination existe, sinon le créer
    if (!is_dir($dossierDestination)) {
        if (!mkdir($dossierDestination, 0755, true)) {
            die('Erreur : Impossible de créer le répertoire de destination.');
        }
    }

    // Vérifier si le répertoire de destination a les bonnes permissions
    if (!is_writable($dossierDestination)) {
        die('Erreur : Le répertoire de destination n\'a pas les permissions nécessaires.');
    }

    $nomFichier = basename($_FILES['image']['name']);
    $cheminFichier = $dossierDestination . $nomFichier;

    // Déplacer le fichier téléchargé vers le répertoire de destination
    if (!move_uploaded_file($_FILES['image']['tmp_name'], $cheminFichier)) {
        die('Erreur : Impossible de déplacer le fichier téléchargé.');
    }

    // Ajouter l'article
    if(addArticle($titre, $contenu, $cheminFichier, $id)) {
        echo "Nouvel article ajouté avec succès";
    } else {
        echo "Erreur lors de l'ajout de l'article.";
    }
}

// Suppression d'un article
if(isset($_POST['supprimer_article'])) {
    $id_article = $_POST['id_article'];
    if(deleteArticle($id_article)) {
        echo "Article supprimé avec succès";
    } else {
        echo "Erreur lors de la suppression de l'article.";
    }
}

// Modification d'un article
if(isset($_POST['modifier_article'])) {
    $id_article = $_POST['id_article'];
    $titre_edit = $_POST['titre_edit'];
    $contenu_edit = $_POST['contenu_edit'];

    // Gestion du téléchargement d'image
    $dossierDestination = "images/";

    // Vérifier si le répertoire de destination existe, sinon le créer
    if (!is_dir($dossierDestination)) {
        if (!mkdir($dossierDestination, 0755, true)) {
            die('Erreur : Impossible de créer le répertoire de destination.');
        }
    }

    // Vérifier si le répertoire de destination a les bonnes permissions
    if (!is_writable($dossierDestination)) {
        die('Erreur : Le répertoire de destination n\'a pas les permissions nécessaires.');
    }

    $nomFichier = basename($_FILES['image_edit']['name']);
    $cheminFichier = $dossierDestination . $nomFichier;

    // Déplacer le fichier téléchargé vers le répertoire de destination
    if (!move_uploaded_file($_FILES['image_edit']['tmp_name'], $cheminFichier)) {
        die('Erreur : Impossible de déplacer le fichier téléchargé.');
    }

    // Mettre à jour l'article
    if(updateArticle($id_article, $titre_edit, $contenu_edit, $cheminFichier)) {
        echo "Article modifié avec succès";
    } else {
        echo "Erreur lors de la modification de l'article.";
    }
}

$articles = getArticles($conn, $id);

?>
