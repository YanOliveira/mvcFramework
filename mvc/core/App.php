<?php
class App {
  public function run(){
    $url = isset($_GET['url']) ? "/".$_GET['url'] : "/";               
    $url = explode("/", $url);      
  
    $currentController = (!empty($url[1]) ? ucfirst($url[1]) : ucfirst(CONFIG_DEFAULT_CONTROLLER))."Controller";
    $currentAction = !empty($url[2]) ? $url[2] : CONFIG_DEFAULT_ACTION;      
    $currentParams = !empty($url[3]) ? array_slice($url, 3) : array();
    
    try{
      $controller = new $currentController();      
      call_user_func_array(array($controller, $currentAction), $currentParams);
    }catch(Exception $e){
      $error = new ErrorController();
      $error->index(404);
    }
  }
}
