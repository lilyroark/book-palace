<?php
class Main {

  private $base_url;

  public function __construct() {}

  public function run($page, $command) {
    switch($page) {
      case "account":
        $this->account($command);
        break;
      case "search":
        header("Location: $this->base_url/views/mySearch.php");
        break;
      case "mybooks":
        header("Location: $this->base_url/MyBooks.php");
        $this->search($command);
        break;
      case "book":
        $this->book($command);
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
  public function search($action) {
    // forward the action to search controller
    $search = new Search();
    $search->run($action);
  }
  public function book($action) {
    // forward the action to quiz controller
    $quiz = new Quiz();
    $quiz->run($action);

  }
}

