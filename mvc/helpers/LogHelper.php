<?php
class LogHelper {
  public function __construct($type, $error){
    $log = new Monolog\Logger($type);
    $log->pushHandler(new Monolog\Handler\StreamHandler("errors.log", Monolog\Logger::WARNING)); 
    $log->addError($error);
  }
}