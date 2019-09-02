<?php
abstract class Controller{
  protected function loadModel($model){    
    $model = ucfirst($model."Model");    
    return new $model;
  }
    
  protected function loadView($view, $data = array()){
    extract($data);    
    require "views/".strtolower($view).".php";
  }

  protected function loadTemplateWithView($template, $view, $data = array()){
    require "views/templates/" . strtolower($template) . ".php";
  }

  protected abstract function index();
}