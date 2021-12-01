<?php

class Config {

  private $base_url;

  public function __construct() {
    $compId = "sc8zt";
    $project_name = "book_palace";
    // $this->base_url = "http://localhost:81/cs4750/book-palace/";
    $this->base_url = "/" . $compId . "/" . $project_name;
  }

  public function getURL() {
    return $this->base_url;
  }
}
