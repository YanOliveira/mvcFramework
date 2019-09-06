<?php
namespace Helpers;

use \Monolog\Handler\StreamHandler;
use \Monolog\Logger;

class Log
{
  public function __construct($type, $error)
  {
    $log = explode("_", $type, 2);
    $filename = strtolower($log[0]);
    $log = new Logger(strtoupper($log[1]));
    $log->pushHandler(new StreamHandler("Logs/" . $filename . ".log", Logger::WARNING));
    $log->addError($error);
  }
}
