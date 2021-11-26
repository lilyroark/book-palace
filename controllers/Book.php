<?php
class Book {

    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function run($command) {
        switch($command) {
            case "book_detail":
                $this->bookDetail();
                break;
            case "add_book":
                $this->addBook();
                break;
            case "add_to_favorite":
                $this->addToFavorite();
                break;
            default:
                break;
        }
    }

    public function bookDetail() {
        include("views/book_detail.php");
    }

    public function addBook() {
        include("views/addBook.php");
    }

    public function addToFavorite() {

    }
}
