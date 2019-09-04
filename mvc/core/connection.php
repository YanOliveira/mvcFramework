<?php
/**
 * Classe Connection 
 * Realiza a conexão com o DB, usando PDO e Singleton.
 * @package core
 * @version 1.0.0
 * @author Yan Oliveira <oliveira.yan02@gmail.com> 
 **/
class connection{
  private static $pdo;  
  
  /**
   * Retorna a instância da conexão com o DB, se não houver cria uma.       
   * Ex.: $pdo = Connection::getInstance();
   * @access public   
   * @return PDO   
  **/ 
  public static function getInstance(){    
    if(!isset(self::$pdo)){      
      try{        
        $opcoes = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8', PDO::ATTR_PERSISTENT => TRUE);  
        self::$pdo = new PDO("mysql:host=" . DB_HOST . "; dbname=" . DB_NAME . "; charset=" . CHARSET . ";", DB_USER, DB_PASS, $opcoes); 
      }catch(PDOException $e){
        new log("DB", $e->getMessage());
        header("Location: ".BASE_URL."error/500");
        exit;
      }
    }
    return self::$pdo;
  }
}