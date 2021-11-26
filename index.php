<?php

spl_autoload_register(function($classname) {
  include "controllers/$classname.php";
});

session_start();

// general config option for setting base_url
$config = new Config();
$base_url = $config->getURL();

$page = "";
$command = "";

// Parse the URL
if (isset($_GET['page']) && isset($_GET['command'])) {
  $page = $_GET['page'];
  $command = $_GET['command'];
}

// if no user is logged in, redirect to login page
if (!isset($_SESSION["username"])) {
  $page = "account";
  $command = "login";
}

$main = new Main();
$main->run($page, $command); // forward the query to appropriate controllers
