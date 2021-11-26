<?php
class Account {

  private $db;
  private $base_url;

  public function __construct() {
    $this->db = new Database();
    $this->config = new Config();
    $this->base_url = $this->config->getURL();
  }

  public function run($action) {

    switch($action) {
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
          header("Location: {$this->base_url}/search/search_form");
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
        header("Location: {$this->base_url}/search/search_form");
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
    include ('views/recent_search.php');
  }

  public function friends() {
    include ('views/friends.php');
  }
}
