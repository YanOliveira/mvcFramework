<?php
class ErrorController extends Controller{
  public function index($err){
    $this->loadTemplateWithView('404');
  }
}