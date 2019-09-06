<?php
session_start();
require __DIR__ . "/vendor/autoload.php";
require "config.php";
require 'routes.php';

$app = new Core\App();
$app->run();
