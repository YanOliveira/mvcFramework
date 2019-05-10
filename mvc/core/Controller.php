<?php
abstract class Controller{
  protected function loadModel($model){    
    $model = ucfirst($model."Model");    
    return new $model;
  }
    
  protected function loadView($view, $data = array()){
    extract($data);
    $view = strtolower($view);
    require "views/".$view.".php";
  }

  protected function loadTemplateWithView($view, $data = array()){
    require "views/template.php";
  }
}