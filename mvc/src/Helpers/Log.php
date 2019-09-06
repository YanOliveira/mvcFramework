<?php
namespace src\Helpers;

use \Monolog\Handler\StreamHandler;
use \Monolog\Logger;

class Log
{
  public function __construct($type, $error)
  {
    if (!file_exists(BASE_DIR . "/Logs")) {
      mkdir(BASE_DIR . "/Logs");
    }
    $log = explode("_", $type, 2);
    $filename = strtolower($log[0]);
    $log = new Logger(strtoupper($log[1]));
    $log->pushHandler(new StreamHandler(BASE_DIR . "/Logs/" . $filename . ".log", Logger::WARNING));
    $log->addError($error);
  }
}
