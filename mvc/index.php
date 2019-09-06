<?php
session_start();
require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/src/Config/constants.php";
require __DIR__ . "/src/Config/routes.php";

$app = new \src\Core\App();
$app->run();
