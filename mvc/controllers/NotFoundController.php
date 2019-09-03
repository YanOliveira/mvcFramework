<?php
class NotFoundController extends Controller{  
  public function index($err = null){
    $this->loadTemplateWithView('index', '404');
  }
}