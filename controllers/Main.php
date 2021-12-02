<?php
class Main {

  public function __construct() {}

  public function run($page, $command) {
    switch($page) {
      case "account":
        $this->account($command);
        break;
      case "search":
        $this->search($command);
        break;
      case "book":
        $this->book($command);
        break;
      default:
        if (isset($_SESSION["username"])) {
          $this->search("search_form");
        } else {
          $this->account("login");
        }
    }
  }

  public function account($command) {
    // forward the command to account controller
    $account = new Account();
    $account->run($command);
  }
  public function search($command) {
    // forward the command to search controller
    $search = new Search();
    $search->run($command);
  }
  public function book($command) {
    // forward the command to quiz controller
    $book = new Book();
    $book->run($command);
  }
}

