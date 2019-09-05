<?php
class ErrorsController extends Controller{  
  public function notfound(){
    $this->loadTemplateWithView('index', 'errors/404');
  }

  public function internal_server(){    
    $this->loadTemplateWithView('index', 'errors/500');
  }
}