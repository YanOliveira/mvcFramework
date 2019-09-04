<?php
class errors_controller extends controller{  
  public function notfound(){
    $this->loadTemplateWithView('index', 'errors/404');
  }

  public function internal_server(){    
    $this->loadTemplateWithView('index', 'errors/500');
  }
}