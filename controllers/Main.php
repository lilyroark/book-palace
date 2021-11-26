<?php
/*
 * Author(s): Sehoan Choi (sc8zt)
 */

class Main {

  private $base_url;
  public function __construct() {
    $this->db = new Database();
    $this->config = new Config();
    $this->base_url = $this->config->getURL();
  }

  public function run($parts) {
    // break down the parsed url into page and action in the page
    $page = $parts[0];
    switch($page) {
    case "account":
      $this->account($parts[1]);
      break;
    case "search":
      header("Location: $this->base_url/views/mySearch.php");
      break;
    case "mybooks":
      header("Location: $this->base_url/MyBooks.php");
      break;
    default:
      if (isset($_SESSION["username"])) { // user is already logged in, redirect to the search page
        header("Location: $this->base_url/views/mySearch.php");
      } else {
        $this->account("login"); // else redirect to the login page
      }
    }

  }

  public function account($action) {
    // forward the action to account controller
    $account = new Account();
    $account->run($action);
  }
}

