<?php
class notfound_controller extends controller{  
  public function index($err = null){
    $this->loadTemplateWithView('index', '404');
  }
}