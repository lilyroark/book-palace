<?php
class Search {

  private $db;

  private $base_url;

  public function __construct() {
    $this->db = new Database();
    $this->config = new Config();
    $this->base_url = $this->config->getURL();
  }

  public function run($command) {
    switch($command) {
      case "search_form":
        $this->searchForm();
        break;
      case "search_result":
        $this->searchResult();
        break;
      default:
        $this->searchForm();
        break;
    }
  }

  public function searchForm() {
    // code related to search form goes here
    include "views/search_form.php";
  }

  public function searchResult() {
    // code related to search result goes here
    include "views/search_result.php";
  }
}
