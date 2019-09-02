<?php
abstract class Model{
  protected $db;    
  
  public function __construct(){    
    global $db;
    $db = Connection::getInstance();    
  }      

  public function executeQuery($query, $params){
    global $pdo;
    try {
        $sql = $pdo->prepare($query);
        $sql->execute($params);
        if ($sql->rowCount() > 0) {
            $data = $sql->fetch(PDO::FETCH_ASSOC);
        } else {
            $data = array();
        }
        return $data;
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
  }

  // public function executeQueryMultipleResult($query, $params){
  //   global $pdo;
  //   try {
  //       $sql = $pdo->prepare($query);
  //       $sql->execute($params);
  //       if ($sql->rowCount() > 0) {
  //           $data = $sql->fetchAll(PDO::FETCH_ASSOC);
  //       } else {
  //           $data = array();
  //       }
  //       return $data;
  //   } catch (PDOException $e) {
  //       echo "Erro: " . $e->getMessage();
  //   }
  // }
}