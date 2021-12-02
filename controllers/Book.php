<?php
class Book {

    private $db;
    private $base_url;

    public function __construct() {
        $this->db = new Database();
        $config = new Config();
        $this->base_url = $config->getURL();
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
            case "edit_book":
                $this->editBook();
                break;
            case "add_book":
                $this->addBook();
                break;
            case "add_review":
                $this->addReview();
                break;
            default:
                break;
        }
    }

  public function removeBook() {
    if (isset($_GET["book"])) {
      $book_result1 = $this->db->query("select * from book1 where isbn=?;","s",$_GET["book"])[0];
      $this->db->query("delete from favorites where isbn=?", "s", $_GET["book"]);
      $this->db->query("delete from review1 where isbn=?", "s", $_GET["book"]);
      $this->db->query("delete from review2 where isbn=?", "s", $_GET["book"]);
      $this->db->query("delete from writes where isbn=?;", "s", $_GET["book"]);
      $this->db->query("delete from checks_out1 where isbn=?", "s", $_GET["book"]);
      $this->db->query("delete from book1 where isbn=?", "s", $_GET["book"]);
      $this->db->query("delete from book2 where title=? and published_date=?;","ss",$book_result1["title"],$book_result1["published_date"]);
    }
    header("Location: {$this->base_url}?page=search&command=search_form");
  }

    public function editBook() {
        $book1 = $this->db->query("select * from book1 where isbn=?;","s", $_GET["book"]);
        if (isset($book1[0])) $book1 = $book1[0];
        $isbn = $book1["isbn"];
        $book2 = $this->db->query("select * from book2 where title=? and published_date=?;","ss",$book1["title"], $book1["published_date"]);
        if (isset($book2[0])) {
            $book2 = $book2[0];
        } else {
            $book2["genre"] = "";
        } 
        $book3 = $this->db->query("select * from writes where isbn=?;","s", $_GET["book"]);
        if (isset($book3[0])) {
            $book3 = $book3[0];
        } else {
            $book3["author_name"] = "";
        }
            
        if (isset($_POST["submit"])) {
            $bookparams = array(
                "book1"=> array("title", "available_count", "published_date"),
                "book2"=> array("title", "published_date", "genre"),
                "writes"=> array("author_name")
            );
            if (isset($_POST["title"]) && $_POST["title"]!=""){
                $this->db->query("update book2 set title=? where title=? and published_date=?;","sss",$_POST["title"], $book1["title"], $book1["published_date"]);
                $this->db->query("update book1 set title=? where isbn=?;","ss",$_POST["title"], $book1["isbn"]);
                $book1["title"] = $_POST["title"];
            }
            if (isset($_POST["available_count"]) && $_POST["available_count"]!=""){
                $this->db->query("update book1 set available_count=? where isbn=?;", "ss", $_POST["available_count"], $book1["isbn"]);
            }
            if (isset($_POST["published_date"]) && $_POST["published_date"]!=""){
                $this->db->query("update book1 set published_date=? where isbn=?;", "ss", $_POST["published_date"], $book1["isbn"]);
                $this->db->query("update book2 set published_date=? where title=? and published_date=?;","sss",$_POST["published_date"], $book1["title"], $book1["published_date"]);
                $book1["published_date"] = $_POST["published_date"];
            }
            if (isset($_POST["genre"]) && $_POST["genre"]!=""){
                $this->db->query("update book2 set genre=? where title=? and published_date=?;","sss",$_POST["genre"], $book1["title"], $book1["published_date"]);
            }
            if (isset($_POST["author_name"]) && $_POST["author_name"]!=""){
                $this->db->query("update writes set author_name=? where isbn=?;", "ss", $_POST["author_name"], $book1["isbn"]);
            }
            unset($_POST["title"]);
            unset($_POST["available_count"]);
            unset($_POST["published_date"]);
            unset($_POST["genre"]);
            unset($_POST["author_name"]);
            unset($_POST["submit"]);

            header("Location: {$this->base_url}?page=search&command=search_form");
        } else {
            include("views/edit_book.php");
        }
    }

    public function bookDetail() {
        if (isset($_GET["book"])) {
            $book_result1 = $this->db->query("select * from book1 where isbn=?;","s",$_GET["book"])[0];
            $book_result2 = $this->db->query("select * from book2 where title=? and published_date=?;","ss",$book_result1["title"],$book_result1["published_date"]);
            if (isset($book_result2[0])) {
                $book_result2 = $book_result2[0];
            } else {
                $book_result2["genre"] = "";
            }
            $author = $this->db->query("select * from writes where isbn=?;","s",$_GET["book"]);
            if (isset($author[0])){
                $author = $author[0];
            } else {
                $author["author_name"] = "";
            }
            $reviews = $this->db->query("select * from (review1 natural join review2) where isbn=?;", "s", $_GET["book"]);
            $isbn = $book_result1["isbn"];
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

  public function addReview() {
    $isbn = $_GET["book"];
    $book = $this->db->query("select * from book1 where isbn=?;", "s", $isbn)[0];
    if(isset($_POST["rating"]) && isset($_POST["comments"])) {
        $this->db->query("call addReview(?, ?, ?, ?);", "ssis", $_SESSION["username"], $_GET["book"], $_POST["rating"], $_POST["comments"]);
        unset($_POST["rating"]);
        unset($_POST["comments"]);
        header("Location: {$this->base_url}");
    }
    include ('views/add_review.php');
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
      }
      else {echo "You don't have administrative privilige";}
      header("Location: {$this->base_url}");
    }
    
    include ('views/mybooks.php');
    header("Location: {$this->base_url}?page=account&command=mybooks");
  }
}
