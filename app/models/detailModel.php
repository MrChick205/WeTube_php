<?php
require_once 'C:\xampp\htdocs\WeTube_php\app\config\connect.php';

class DetailModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getMovies($movieID) {
        $sql = "SELECT m.movie_id, m.title, m.description, m.movie_url, m.poster, m.type_id, t.type_name
                FROM movies m
                JOIN type t ON m.type_id = t.type_id
                WHERE m.movie_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $movieID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getRelatedMovies($movieID, $typeID) {
        $sql = "SELECT m.movie_id, m.title, m.description, m.movie_url, m.poster, m.type_id, t.type_name
                FROM movies m
                JOIN type t ON m.type_id = t.type_id
                WHERE m.type_id = ? AND m.movie_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ii', $typeID, $movieID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
?>
