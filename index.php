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
if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
if (isset($_GET['command'])) {
  $command = $_GET['command'];
}

if (!isset($_SESSION["username"])) {
  $page = "account";
  $command = "login";
}

$main = new Main();
$main->run($page, $command);
