<?php
class Conection{
  private static $pdo;  
  private function Conection(){

  }

  public static function getInstance(){    
    if(!isset(self::$pdo)){      
      try{        
        $opcoes = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8', PDO::ATTR_PERSISTENT => TRUE);  
        self::$pdo = new PDO("mysql:host=" . DB_HOST . "; dbname=" . DB_NAME . "; charset=" . CHARSET . ";", DB_USER, DB_PASS, $opcoes); 
      }catch(PDOException $e){
        echo "Erro: ".$e->getMessage();
        exit;
      }
    }
    return self::$pdo;
  }
}