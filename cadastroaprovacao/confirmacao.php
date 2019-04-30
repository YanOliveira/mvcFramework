<?php
require('config.php');
if(isset($_GET['cod']) && !empty($_GET['cod'])){
  $cod = addslashes($_GET['cod']);
  $sql = $pdo->prepare("UPDATE users SET ativado = '1' WHERE MD5(email) = ?" );
  $sql->execute(array($cod));
  echo "Confirmado!";
}else{
  header('Location: index.php');
}
?>