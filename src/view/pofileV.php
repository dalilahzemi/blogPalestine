<?php
$lang_file = '../langMulti/fr_lang.php'; // Default to French
if (isset($_GET['lang'])) {
    if ($_GET['lang'] == 'en') {
        $lang_file = '../langMulti/en_lang.php';
    }
}
include($lang_file);

include '../controller/profileC.php';
?>
<!DOCTYPE html>
<html lang="<?php echo $lang['langMulti']; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $lang['title']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <header class="bg-dark py-3">
        <div class="container-head">
            <h1 class="text-white head">Palstine's Blogs</h1>
            <h2 class="text-white name">Your Profile : <?php echo $prenom . ' ' . $nom; ?></h2> <!-- Affichage du nom et du prénom -->
        </div>
    </header>
    <nav class="navbar1 navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand navbarlink" href="blogsV.php">Accueil</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
          
        </div>
    </nav>
        <div class="container-profile">
            <div class="container-add">
            <!-- Formulaire pour ajouter un nouvel article -->
            <h1 class="titre-blog">Creer un nouveau Blog :</h1>
            <form method="post" class="addart mt-3" action="" enctype="multipart/form-data">
                <input type="text" name="titre" class="form-control mb-2" placeholder="Titre">
                <textarea name="contenu" class="form-control mb-2" placeholder="Contenu de l'article"></textarea>
                <input type="file" name="image" class="form-control mb-2" accept="image/*">
                <input type="submit" class="btn btn-primary" name="ajouter_article" value="Ajouter">
            </form>
            </div>
        <div class="container-see">
        <!-- Affichage des articles existants -->
        <h1 class="titre-blog">Dernier Blogs :</h1>
        <?php
        $result = getArticles($conn,$id);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<section class='article mt-3'>";
                echo "<h2 class='h2art'>" . $row["titre"] . "</h2>";
                echo "<div class='img-container'>";
                echo "<img src='" . $row["chemin_image"] . "' class='img-fluid imgart' alt='Photo de l'article'>";
                echo "</div>";
                echo "<p class='part'>" . $row["contenu"] . "</p>";

                // Affichage du nom et prénom de l'utilisateur
                $auteur = getUserInfo($conn, $row['id_user']);
                echo "<p class='auteur'>Publié par : $auteur</p>";

                echo "<form method='post' class='formart' action=''>";
                echo "<input type='hidden' name='id_article' class='inpart' value='" . $row["id"] . "'>";
                echo "<input type='submit' name='supprimer_article' class='btn btn-danger' value='Supprimer'>";
                echo "</form>";

                // Formulaire pour éditer un article
                echo "<form method='post' class='editart mt-3' action='' enctype='multipart/form-data'>";
                echo "<input type='hidden' name='id_article' value='" . $row["id"] . "'>";
                echo "<input type='text' name='titre_edit' class='form-control mb-2' value='" . $row["titre"] . "'>";
                echo "<textarea name='contenu_edit' class='form-control mb-2'>" . $row["contenu"] . "</textarea>";
                echo "<input type='file' name='image_edit' class='form-control mb-2' accept='image/*'>";
                echo "<input type='submit' class='btn btn-primary' name='modifier_article' value='Modifier'>";
                echo "</form>";

                echo "</section>";
            }
        } else {
            echo "<p class='mt-3'>0 résultats</p>";
        }
        ?>
        </div>
    </div>
    <?php
include '../footer.html'; // Include the footer file
?>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
