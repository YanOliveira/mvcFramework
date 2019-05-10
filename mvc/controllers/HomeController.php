<?php
class HomeController extends Controller{
  public function index(){    
    $this->loadTemplateWithView('home', array("teste", "teste 2"));    
    $teste = $this->loadModel("users");
    $teste->hello();
  }
}