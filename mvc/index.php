<?php
session_start();
require "config.php";
require "autoload.php";

$app = new App;
$app->run();