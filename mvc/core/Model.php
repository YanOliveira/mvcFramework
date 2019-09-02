<?php
abstract class Model{  
  
  public function __construct(){    
    global $pdo;
    $pdo = Connection::getInstance();    
  }      

  public function executeQuery($query, $params = null){
    global $pdo;
    try {                                       
        $sql = $pdo->prepare($query);                 
        $sql->execute($params);                
        if ($sql->rowCount() > 0) {
          if($sql->rowCount() > 1){
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
          }else{
            $data[0] = $sql->fetch(PDO::FETCH_ASSOC);
          }            
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