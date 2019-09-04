<?php
session_start();
require "vendor/autoload.php";
require "config.php";
require "autoload.php";
require 'routes.php';

$log = new Monolog\Logger("log");
$log->pushHandler(new Monolog\Handler\StreamHandler("errors.log", Monolog\Logger::WARNING));
// $log->addError("acesso ao sistema.");

$app = new app;
$app->run();