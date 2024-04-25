<?php
// Article.php
class Article {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getArticles() {
        $sql = "SELECT article.*, utilisateurs.nom AS nom_utilisateur, utilisateurs.prenom AS prenom_utilisateur
                FROM article
                INNER JOIN utilisateurs ON article.id_user = utilisateurs.id";
        return $this->conn->query($sql);
    }

    public function deleteArticle($id) {
        $sql = "DELETE FROM article WHERE id=$id";
        return $this->conn->query($sql);
    }
}

?>



