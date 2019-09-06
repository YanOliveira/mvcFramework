<?php
namespace Helpers;

use \Monolog\Handler\StreamHandler;
use \Monolog\Logger;

class Log
{
  public function __construct($type, $error)
  {
    $log = new Logger($type);
    $log->pushHandler(new StreamHandler("errors.log", Logger::WARNING));
    $log->addError($error);
  }
}
