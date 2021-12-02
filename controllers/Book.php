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
    case "add_book":
      $this->addBook();
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
      $book = $_GET["book"];
      try{
        $insert = $this->db->query("INSERT INTO favorites(username, isbn) VALUES (?, ?)", "ss", $_SESSION['username'], $book);
      }catch(Exception $e){ //if it's already in list of favorites do nothing

      }
      header("Location: {$this->base_url}?page=account&command=mybooks");
    }
  }
  public function addBook() {
    if(isset($_POST["bookName"]) and isset($_POST["bookAuthor"]) and isset($_POST["bookISBN"]) and isset($_POST["bookDate"]) and isset($_POST["bookGenre"])  ){
      $user = $_SESSION["username"];
      $bookname = $_POST["bookName"];
      $bookauthor = $_POST["bookAuthor"];
      $bookisbn = $_POST["bookISBN"];
      $date = $_POST["bookDate"];
      $count = 1;
      $genre = $_POST["bookGenre"];
      $datetoday = date("Y-m-d");
      $bookauthorbday = "0001-01-01";  
      $useremail = $this->db->query("select email_address from user1 where username = ?;","s", $user)[0]["email_address"];


      if(preg_match('/^\w+@virginia\.edu$/i', $useremail) > 0){
      $add_book2_stmt = $this->db->query("INSERT INTO book2 (title, published_date,genre) VALUES (?,?,?)", "sss", $bookname, $date, $genre);  
      $add_book1_stmt = $this->db->query("INSERT INTO book1 (isbn, title, available_count, published_date) VALUES (?,?,?,?)", "ssis", $bookisbn, $bookname, $count, $date);    
      $add_author_stmt = $this->db->query("INSERT INTO author (name, birthday, primary_genre) VALUES (?,?,?)", "sss", $bookauthor, $bookauthorbday , $genre);    
      $add_writes_stmt = $this->db->query("INSERT INTO writes (author_name, author_birthday, isbn) VALUES (?,?,?)","sss", $bookauthor, $bookauthorbday , $bookisbn);    
      $add_checkout_stmt = $this->db->query("INSERT INTO checks_out1(username, isbn, date) VALUES (?,?,?)", "sss", $user, $bookisbn , $datetoday);
      header("Location: {$this->base_url}");
    }
      else {header("Location: {$this->base_url}error");}
    }
    
    include ('views/mybooks.php');
    header("Location: {$this->base_url}?page=account&command=mybooks");
  }
}
