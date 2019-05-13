<?php
session_start();
require "config.php";
require "autoload.php";
require 'routes.php';

$app = new App;
$app->run();