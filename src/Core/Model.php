<?php
namespace src\Core;

use \PDO;
use \PDOException;
use \src\Core\Connection;
use \src\Helpers\Log;

/**
 * Classe Model
 * Padroniza o comportamento e alguns métodos para todos os models.
 * @package core
 * @version 1.0.0
 * @author Yan Oliveira <oliveira.yan02@gmail.com>
 **/
abstract class Model
{
  public function __construct()
  {
    global $pdo;
    $pdo = Connection::getInstance();
  }

  /**
   * Executa uma query no db utilizando o prepare statements do PDO.
   * Recebe uma string com query a ser preparada e um array com os parâmetros.
   * Ex.: executeQuery('select * from tabela where id=?', array(1));
   * @access protected
   * @param String $query
   * @param Array $params
   * @return Array
   * @example executeQuery('select * from tabela where id=?', array(1))
   **/
  protected function executeQuery($query, $params = null)
  {
    global $pdo;
    try {
      if (!empty($params)) {
        $sql = $pdo->prepare($query);
        $sql->execute($params);
      } else {
        $sql = $pdo->query($query);
      }
      if (empty($sql)) {
        throw new PDOException("Unable to query: '" . $query . "'");
      }
      if ($sql->rowCount() > 0) {
        if ($sql->rowCount() > 1) {
          $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        } else {
          $data[0] = $sql->fetch(PDO::FETCH_ASSOC);
        }
      } else {
        $data = array();
      }
      return $data;
    } catch (PDOException $e) {
      new Log("PDO_QUERY", $e->getMessage());
    }
  }
}
