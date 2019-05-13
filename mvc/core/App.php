<?php
class App {
  public function run(){
    $url = isset($_GET['url']) ? "/".$_GET['url'] : "/";               
    $url = $this->checkRoute($url);    
    echo $url;
    $url = explode("/", $url);
    
  
    $currentController = (!empty($url[1]) ? ucfirst($url[1]) : ucfirst(CONFIG_DEFAULT_CONTROLLER))."Controller";
    $currentAction = !empty($url[2]) ? $url[2] : CONFIG_DEFAULT_ACTION;      
    $currentParams = !empty($url[3]) ? array_slice($url, 3) : array();
    
    try{
      $controller = new $currentController();
      if(!method_exists($currentController, $currentAction)){
        throw new Exception();
      }
      call_user_func_array(array($controller, $currentAction), $currentParams);
    }catch(Exception $e){
      $error = new NotFoundController();
      $error->index(404);
    }
  }

  private function checkRoute($url){
    global $routes;
    foreach($routes as $key => $newurl){
      $pattern = preg_replace('(\{[a-z0-9]{1,}\})', '([a-z0-9-]{1,})', $key);            
      if(preg_match('#^('.$pattern.')*$#i', $url, $matches) === 1){
        array_shift($matches);
        array_shift($matches);
        $itens = array();
        if(preg_match_all('(\{[a-z0-9]{1,}\})', $key, $m)){
          $itens = preg_replace('(\{|\})', '', $m[0]);                    
        }
        $args = array();
        foreach($matches as $key => $match){
          $args[$itens[$key]] = $match;          
        }      
        foreach($args as $key => $value){
          $newurl = str_replace(':'.$key, $value, $newurl);          
        }   
        $url = $newurl;             
        break;
      }
    }
    return $url;
  }
}
