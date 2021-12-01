<?php
class Account {

  private $db;
  private $base_url;

  public function __construct() {
    $this->db = new Database();
    $this->config = new Config();
    $this->base_url = $this->config->getURL();
  }

  public function run($command) {

    switch($command) {
      case "login":
        $this->login();
        break;
      case "logout":
        $this->logout();
        break;
      case "mybooks":
        $this->mybooks();
        break;
      case "friends":
        $this->friends();
        break;
      case "add_friends":
        $this->addFriends();
        break;
      case "add_reviews":
        $this->addReviews();
        break;
      case "remove_favorite":
        $this->removeFav();
        break;
      case "add_favorite":
        $this->addFav();
        break;
      default:
        $this->login();
    }
  }

  public function login() {
    $error_msg = "";
    if (isset($_POST["username"])) { // check if any username is in post object
      $data = $this->db->query("select * from user1 where username = ?;", "s", $_POST["username"]);
      if ($data === false) { // query failed
        $error_msg = "Error checking for user";
      } else if (!empty($data)) {
        // query succeeded and an existing user's found, validate password
        if (password_verify($_POST["password"], $data[0]["password"])) {
          $_SESSION["username"] = $data[0]["username"];
          header("Location: {$this->base_url}?page=search&command=search_form");
          return;
        } else {
          $error_msg = "Invalid Password";
        }
      } else {
        // query succeeded but no user's found, sign up a new user
        $password = $_POST['password'];
        $hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $insert = $this->db->query("insert into user2 (email_address, displayname) values (?, ?);", "ss", $_POST["email"], $_POST["dspName"]);
        $insert &= $this->db->query("insert into user1 (username, email_address, password) values (?, ?, ?);", "sss", $_POST["username"], $_POST["email"], $hash);
        if ($insert == false) {
          $error_msg = "Error creating new user";
        }

        // create session obejcts to maintain user's state in the site
        $_SESSION["username"] = $_POST["username"];
        header("Location: {$this->base_url}?page=search&command=search_form");
        return;
      }
    }

    include "views/login.php";
  }

  private function logout() {
    session_start(); // join existing session
    session_destroy(); // destroy existing session
    header("Location: {$this->base_url}/"); // redirect to home page
  }

  public function mybooks() {
    // code related to mybooks goes here
    $mybooks = $this->db->query("select * from user1 natural join favorites natural join book1 where username = ?;", "s", $_SESSION["username"]);
    include ('views/mybooks.php');
  }

  public function friends() {
    $friends = $this->db->query("select friend_username from friends where username = ?;", "s", $_SESSION["username"]);
    include ('views/friends.php');
  }

  public function addFriends() {
    $search_result = [];
    if (isset($_POST["keyword"])) {
      $keyword = "%" . $_POST["keyword"] . "%";
      $search_result = $this->db->query("select displayname, email_address from user2 where displayname like ? or email_address like ?;", "ss", $keyword, $keyword);
    }

    if (isset($_GET["name"])) {
      $displayName = $_GET["name"];
      $friendUsername = $this->db->query("select username from user1 natural join user2 where displayname = ?;", "s", $displayName);
      // print_r($friendUsername);
      $insert = $this->db->query("insert into friends (username, friend_username) values (?, ?);", "ss", $_SESSION["username"], $friendUsername[0]["username"]);
      if ($insert == false) {
        $error_msg = "Error creating new user";
      }
      header("Location: {$this->base_url}?page=account&command=friends");
    }
    include ('views/add_friends.php');
  }

  public function addReviews() {
    $search_result = [];
    $second = [];
    $num_reviews =0;
    $isbn =  $_GET["name"];
      $user = $_SESSION['username'];
    $review1 = $this->db->query("Select date, rating from review1 where username=? and isbn=?", "ss", $user, $isbn);
    $review2 = $this->db->query("Select comments from review2 where username=? and isbn=?", "ss", $user, $isbn);
    if(sizeof($review1) >0){
      $review1 = end($review1);
      $review2= $review2[0];
    }else{
      $review1 = array(
        'date' => '',
        'rating' => ''
    );
    $review2 = array(
      'comments' => ''
  );
    }
    
    $book = $this->db->query("Select title from book1 where isbn=?", "s", $isbn);
    if (isset($_POST["comments"]) && isset($_POST["date"]) && isset($_POST["rating"])) {
      $rating =$_POST["rating"];
      $comments =$_POST["comments"];
      $date = date("Y-m-d", strtotime($_POST["date"])) ;
      
     
      try{ #“Call addReview(?, ?, ?, ?);”, “ssis “, username, isbn, rating, comments);
       $search_result = $this->db->query("Call addReview(?, ?, ?, ?);", "ssis", $username, $isbn, $rating, $comments);
      // $search_result = $this->db->query("Insert into review1 (username, isbn, date, rating) VALUES (?, ?, ?, ?)", "ssss", $user, $isbn, $date, $rating);
      // $search_result = $this->db->query("Insert into review2 (username, isbn, comments) VALUES (?, ?, ?)", "sss", $user, $isbn, $comments);
    }catch(Exception $ew){
      $search_result = $this->db->query("UPDATE review1 SET rating=? where username=?", "ss", $rating, $user);
      $search_result = $this->db->query("UPDATE review2 SET comments=? where username=? and isbn=?", "sss", $comments, $user, $isbn);
    }

      header("Location: {$this->base_url}?page=account&command=add_reviews&name={$isbn}");
    }
    include ('views/add_reviews.php');
  }

  
  public function removeFav() {
    $search_result = [];
    $isbn =  $_GET["name"];
    $user = $_SESSION['username'];
    $review1 = $this->db->query("DELETE FROM favorites where username=? and isbn=?", "ss", $user, $isbn);
    
   

      header("Location: {$this->base_url}?page=account&command=mybooks");
    
    // include ('views/add_reviews.php');
  }

  
  public function addFav() {
    $search_result = [];
    $isbn =  $_GET["name"];
    $user = $_SESSION['username'];
    $review1 = $this->db->query("INSERT INTO favorites(username, isbn) VALUES (?, ?)", "ss", $user, $isbn);
    
   

    // header("Location: {$this->base_url}?page=search&command=search_form");
    
    include ('views/mybooks.php');
  }
}
