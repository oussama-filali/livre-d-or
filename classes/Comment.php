<?php
require_once 'Database.php';

class Comment {
    private $pdo;

    public function __construct() {
        $db = new Database();
        $this->pdo = $db->getConnection();
    }

    public function getAllComments() {
        $stmt = $this->pdo->query("SELECT comment.*, user.prenom, user.nom FROM comment JOIN user ON comment.id_user = user.id ORDER BY comment.date DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCommentsWithPagination($start, $limit) {
        $stmt = $this->pdo->prepare("SELECT comment.*, user.prenom, user.nom FROM comment JOIN user ON comment.id_user = user.id ORDER BY comment.date DESC LIMIT ?, ?");
        $stmt->bindParam(1, $start, PDO::PARAM_INT);
        $stmt->bindParam(2, $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalComments() {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM comment");
        return $stmt->fetchColumn();
    }

    public function addComment($comment, $id_user) {
        $stmt = $this->pdo->prepare("INSERT INTO comment (comment, id_user) VALUES (?, ?)");
        return $stmt->execute([$comment, $id_user]);
    }

    public function deleteComment($id, $id_user) {
        $stmt = $this->pdo->prepare("DELETE FROM comment WHERE id = ? AND id_user = ?");
        return $stmt->execute([$id, $id_user]);
    }

    public function updateComment($id, $newComment) {
        $stmt = $this->pdo->prepare("UPDATE comment SET comment = ? WHERE id = ?");
        return $stmt->execute([$newComment, $id]);
    }

    public function getUserComments($id_user) {
        $stmt = $this->pdo->prepare("SELECT * FROM comment WHERE id_user = ? ORDER BY date DESC");
        $stmt->execute([$id_user]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCommentById($id, $id_user) {
        $stmt = $this->pdo->prepare("SELECT * FROM comment WHERE id = ? AND id_user = ?");
        $stmt->execute([$id, $id_user]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
