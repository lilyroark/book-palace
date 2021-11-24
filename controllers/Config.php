<?php

class Config {

    private $base_url;

    public function __construct() {
        $this->base_url = "ok";
    }

    public function getURL() {
        return $this->base_url;
    }
}