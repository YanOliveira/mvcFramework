<?php
define("CONFIG_ENV", "development");
define("CONFIG_DSN", "mysql:dbname=mvc;host=localhost");
define("CONFIG_DB_USER", "root");
define("CONFIG_DB_PASS", "root");
define("CONFIG_BASE_URL", "http://localhost/projects/b7/mvc/");

define("CONFIG_DEFAULT_CONTROLLER", "home");
define("CONFIG_DEFAULT_ACTION", "index");

global $db;

try{
  $db = new PDO(CONFIG_DSN, CONFIG_DB_USER, CONFIG_DB_PASS);
}catch(PDOException $e){
  echo "Erro: ".$e->getMessage();
  exit;
}