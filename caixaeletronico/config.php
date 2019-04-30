<?php
  try{
    define("DSN", "mysql:dbname=caixaeletronico;host=localhost");
    define("DBUSER", "root");
    define("DBPASS", "root");
    $pdo = new PDO(DSN, DBUSER, DBPASS);    
  }catch(PDOException $e){
    echo "Erro: ".$e->getMessage();
  }
