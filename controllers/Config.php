<?php

class Config {

    private $base_url;

    public function __construct() {
        $this->base_url = "http://localhost/book-palace";
        //Changed base url for local development "cs4750/book-palace";
    }

    public function getURL() {
        return $this->base_url;
    }
}