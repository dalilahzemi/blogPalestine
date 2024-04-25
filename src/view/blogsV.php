<?php
// Déterminez la langue choisie (par exemple, à partir d'un paramètre d'URL)
$lang_file = '../langMulti/fr_lang.php'; // Par défaut, choisissez le français
if (isset($_GET['lang'])) {
    if ($_GET['lang'] == 'en') {
        $lang_file = '../langMulti/en_lang.php';
    }
}
include($lang_file);

// Inclure le contrôleur des blogs
include '../controller/blogsC.php';

?>
<!DOCTYPE html>
<html lang="<?php echo $lang['langMulti']; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $lang['title']; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Votre CSS personnalisé -->
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
<header class="bg-dark py-3">
    <div>
        <a href="?lang=fr"><?php echo $lang['lang_fr']; ?></a>
        <a href="?lang=en"><?php echo $lang['lang_en']; ?></a>
    </div>
    <div class="container">
        <h1 class="text-white"><?php echo $lang['blog_title']; ?></h1>
    </div>
</header>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="blogsV.php"><?php echo $lang['home']; ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="pofileV.php"><?php echo $lang['profile']; ?> (<?php echo $prenom . ' ' . $nom; ?>)</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <?php
        if ($articles->num_rows > 0) {
            while($row = $articles->fetch_assoc()) {
                echo "<section class='articleb mt-4'>";
                echo "<h2 class='h2artb'>" . $row["titre"] . "</h2>";
                echo "<div class='img-containerb'>";
                echo "<img src='" . $row["chemin_image"] . "' class='img-fluid imgartb' alt='Photo de l'article'>";
                echo "</div>";
                echo "<p class='partb'>" . $row["contenu"] . "</p>";
                echo "<p>Publié par: " . $row["prenom_utilisateur"] . " " . $row["nom_utilisateur"] . "</p>";
                echo "<form method='post' class='formartb' action=''>";
                echo "<input type='hidden' name='id_article' class='inpartb' value='" . $row["id"] . "'>";
                echo "</form>";
                echo "</section>";
            }
        } else {
            echo "<p>" .$lang['no_results']. "</p>"; // Fixed missing echo and added concatenation
        }
        ?>
    </div>
    <footer class="bg-dark text-white py-3 text-center">
        <p>&copy; <?php echo date('Y'); ?> <?php echo $lang['rights_reserved']; ?></p>
    </footer>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

