<?php
  session_start();
  require('config.php');

  if(!isset($_SESSION['banco']) || empty($_SESSION['banco'])){
    header('Location: login.php');
    exit;
  }
  
  if(isset($_POST['valor']) && !empty($_POST['valor'])){        
    $tipo = addslashes($_POST['tipo']);
    $valor = str_replace(",", ".", $_POST['valor']);
    $valor = floatval($valor);        
    
    $sql = $pdo->prepare("INSERT INTO movimentacoes (conta_id, valor, tipo) VALUES (?, ?, ?)");
    $sql->execute(array($_SESSION['banco'], $valor, $tipo));

    
    if($tipo == 1){
      $sql = $pdo->prepare("UPDATE contas SET saldo = saldo + ?");    
      $sql->execute(array($valor));
    }else{
      $sql = $pdo->prepare("UPDATE contas SET saldo = saldo - ?");    
      $sql->execute(array($valor));
    }

    header('Location: index.php');
  }
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Nova transação</title>
</head>
<body>
  <h1>Nova Transação</h1>
  <form method="POST">
    <select name="tipo">
      <option value="1">Depósito</option>
      <option value="0">Transferência</option>  
    </select>
    Valor: <input type="text" pattern="[0-9.,]{1,}" name="valor"><br/>

    <input type="submit" value="Adicionar">
  
  </form>
</body>
</html>