<?php
session_start();
require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/Config/constants.php";
require __DIR__ . "/Config/routes.php";

$app = new Core\App();
$app->run();
