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
    $available_only = false;
    $search_result = [];
    if (isset($_POST["keyword"])) {
      $keyword = $_POST["keyword"];
      $filter = "%" . $keyword . "%";
      $available_only = isset($_POST["available_only"]);
      
      if(isset($_POST['by'])) {
        $searchBy = $_POST['by'];
      }else{
        $searchBy = "title";
      }

      if ($available_only && $searchBy =='title') {
        $search_result = $this->db->query("select * from book1 where title like ? and available_count > 0;", "s", $filter);
      } else if($available_only && $searchBy =='author') {
        $search_result = $this->db->query("select * from book1 natural join writes where author_name like ? and available_count > 0;", "s", $filter);
      }else if(!$available_only && $searchBy =='title'){
        $search_result = $this->db->query("select * from book1 where title like ?;", "s", $filter);
      }else{
        $search_result = $this->db->query("select * from book1 natural join writes where author_name like ?;", "s", $filter);
      }
    }
    include "views/search_form.php";
  }

  public function searchResult() {
    // code related to search result goes here
    include "views/search_result.php";
  }
}
