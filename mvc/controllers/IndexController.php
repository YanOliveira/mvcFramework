<?php
class IndexController extends Controller{
  public function index(){    
    $this->loadTemplateWithView('index', array("teste", "teste 2"));    
    $teste = $this->loadModel("users");
    $teste->hello();
  }
}