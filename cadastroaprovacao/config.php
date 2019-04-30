<?php
  try{
    define("DSN", "mysql:dbname=cadastro_autorizacao;host=localhost");
    define("DBUSER", "root");
    define("DBPASS", "root");
    $pdo = new PDO(DSN, DBUSER, DBPASS);    
  }catch(PDOException $e){
    echo "Erro: ".$e->getMessage();
  }
