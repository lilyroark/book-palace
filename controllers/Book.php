<?php
class Book {

  private $db;
  private $base_url;

  public function __construct() {
    $this->db = new Database();
    $this->config = new Config();
    $this->base_url = $this->config->getURL();
  }

  public function run($command) {
    switch($command) {
    case "book_detail":
      $this->bookDetail();
      break;
    case "remove_book":
      $this->removeBook();
      break;
    case "add_favorite":
      $this->addFavorite();
      break;
    default:
      break;
    }
  }

  public function removeBook() {
    if (isset($_GET["book"])) {
      $book_result1 = $this->db->query("select * from book1 where isbn=?;","s",$_GET["book"])[0];
      $this->db->query("delete from writes where isbn=?;", "s", $_GET["book"]);
      $this->db->query("delete from checks_out1 where isbn=?", "s", $_GET["book"]);
      $this->db->query("delete from book1 where isbn=?", "s", $_GET["book"]);
      $this->db->query("delete from book2 where title=? and published_date=?;","ss",$book_result1["title"],$book_result1["published_date"]);
    }
    header("Location: {$this->base_url}?page=search&command=search_form");
  }

  public function bookDetail() {
    if (isset($_GET["book"])) {
      $book_result1 = $this->db->query("select * from book1 where isbn=?;","s",$_GET["book"])[0];
      $book_result2 = $this->db->query("select * from book2 where title=? and published_date=?;","ss",$book_result1["title"],$book_result1["published_date"])[0];
      $author = $this->db->query("select * from writes where isbn=?;","s",$_GET["book"])[0];
      $reviews = $this->db->query("select * from (review1 natural join review2) where isbn=?;", "s", $_GET["book"]);
      include("views/book_detail.php");  
    } else {
      header("Location: {$this->base_url}?page=search&command=search_form");
    }
  }

  public function addFavorite() {
    if (isset($_GET["book"])) {
      $isbn = $_GET["book"];
      $user = $_SESSION["username"];
      $this->db->query("insert into favorites(username, isbn) values (?, ?);", "ss", $user, $isbn);
      header("Location: {$this->base_url}?page=account&command=mybooks");
    }
  }
}
