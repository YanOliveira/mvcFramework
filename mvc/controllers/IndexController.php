<?php
class IndexController extends Controller{
  public function index(){    
    $this->loadTemplateWithView('index', array("teste", "teste 2"));    
    $teste = $this->loadModel("users");
    $teste->hello();
  }

  public function teste($id, $nome){   
    $data = array(
      'id' => $id, 
      'nome' => $nome
    );
    $this->loadTemplateWithView('teste', $data);    
    $teste = $this->loadModel("users");
    $teste->hello();
  }
}