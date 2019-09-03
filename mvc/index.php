<?php
session_start();
require "config.php";
require "autoload.php";
require 'routes.php';

$app = new app;
$app->run();