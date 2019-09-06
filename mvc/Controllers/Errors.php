<?php
namespace Controllers;

use \Core\Controller;

class Errors extends Controller
{
  public function notfound()
  {
    $this->loadTemplateWithView('index', 'errors/404');
  }

  public function internal()
  {
    $this->loadTemplateWithView('index', 'errors/500');
  }
}
