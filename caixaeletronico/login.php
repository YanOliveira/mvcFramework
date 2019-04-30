<?php
  session_start();
  require('config.php');
  
  if(isset($_SESSION['banco']) && !empty($_SESSION['banco'])){
    header('Location: index.php');
    exit;
  }  
  if(isset($_POST['agencia']) && !empty($_POST['agencia'])){
    $agencia = addslashes($_POST['agencia']);
    $conta = addslashes($_POST['conta']);
    $senha = md5(addslashes($_POST['senha']));
        
    $sql = $pdo->prepare("SELECT * FROM contas WHERE agencia = ? AND conta = ? AND senha = ?");
    $sql->execute(array($agencia, $conta, $senha));

    if($sql->rowCount()>0){
      $sql = $sql->fetch();
      $_SESSION['banco'] = $sql['id'];
      header('Location: index.php');
      exit;
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Caixa eletronico - login</title>
</head>
<body>
  <form method="POST">
    Ag:<input type="text" name="agencia"/><br/>
    Cc:<input type="text" name="conta"/><br/>
    Senha: <input type="password" name="senha"><br/>
    <input type="submit" value="Entrar">


  
  </form>
</body>
</html>