<?php
namespace src\Core;

use \src\Controllers\Errors;

/**
 * Classe App
 * Controla o fluxo do MVC, identificando as rotas e atribuindo ao Controller correto.
 * @package core
 * @version 1.0.0
 * @author Yan Oliveira <oliveira.yan02@gmail.com>
 **/
class App
{
  /**
   * Instancia o Controller, executa o método, passando os parâmetros. De acordo com a url.
   * @access public
   **/
  public function run()
  {
    $url = isset($_GET['url']) ? "/" . $_GET['url'] : "/";
    $url = $this->checkRoute($url);
    $url = explode("/", $url);

    $currentController = "src\\Controllers\\" . (!empty($url[1]) ? ucfirst($url[1]) : ucfirst(DEFAULT_CONTROLLER));
    $currentAction = !empty($url[2]) ? strtolower($url[2]) : strtolower(DEFAULT_ACTION);
    $currentParams = !empty($url[3]) ? array_slice($url, 3) : array();
    try {
      $controller = new $currentController();
      if (!method_exists($currentController, $currentAction)) {
        throw new Exception();
      }
      call_user_func_array(array($controller, $currentAction), $currentParams);
    } catch (Exception $e) {
      $error = new Errors();
      $error->notfound();
    }
  }

  /**
   * Verifica a url e identica todas suas partes, separando o controller, o métodos e os parâmetros.
   * Possibilita a obtenção dos parâmetros de acordo com definido no routes.php
   * @access private
   * @param String $url
   * @return String $url
   **/
  private function checkRoute($url)
  {
    global $routes;
    foreach ($routes as $key => $newurl) {
      $pattern = preg_replace('(\{[a-z0-9]{1,}\})', '([a-z0-9-]{1,})', $key);
      if (preg_match('#^(' . $pattern . ')*$#i', $url, $matches) === 1) {
        array_shift($matches);
        array_shift($matches);
        $itens = array();
        if (preg_match_all('(\{[a-z0-9]{1,}\})', $key, $m)) {
          $itens = preg_replace('(\{|\})', '', $m[0]);
        }
        $args = array();
        foreach ($matches as $key => $match) {
          $args[$itens[$key]] = $match;
        }
        foreach ($args as $key => $value) {
          $newurl = str_replace(':' . $key, $value, $newurl);
        }
        $url = $newurl;
        break;
      }
    }
    return $url;
  }
}
