<?php
require_once '../models/detailModel.php';

class DetailController {
    private $conn;

    public function __construct($conn) {
        $this->conn = new DetailModel($conn);
    }

    public function showMovieDetail($movieID) {
        // Get current movie data
        $movie = $this->conn->getMovies($movieID);
        if ( $movie) {
            return  $movie;
        } else {
            return ["error" => "Movie not found."];
        }
    }
    // Get list of related movies
    public function getRelatedMovies($movieID) {
        $movie = $this->conn->getMovies($movieID);
        $typeID =  $movie ['type_id'];

        $relatedMovies = $this->conn->getRelatedMovies($movieID, $typeID);

        if ($relatedMovies) {
            return $relatedMovies;
        } else {
            return [];
        }
    }
    }

?>