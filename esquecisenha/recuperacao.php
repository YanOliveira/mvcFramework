<?php
  session_start();
  require("config.php");
  if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
    header('Location: index.php');
  }

  if(isset($_GET['token']) && !empty($_GET['token'])){
    $token = addslashes($_GET['token']);
    $sql = $pdo->prepare("SELECT * FROM users_tokens WHERE token=? AND used=0");
    $sql->execute(array($token));    
    if($sql->rowCount() <= 0){
      echo "Token inválido ou já foi usado.";
      echo '<a href="login.php">Voltar</a><br /><br />';
      exit;
    }else{
      $user = $sql->fetch();
    }
  }else{
    echo "token de recuperação inexistente.";
    echo '<a href="login.php">Voltar</a><br /><br />';
    exit;
  }

  if(isset($_POST['novasenha']) && isset($_POST['novasenha_confirmacao'])){
    if($_POST['novasenha'] === $_POST['novasenha_confirmacao']){
      $novasenha = md5(addslashes($_POST['novasenha']));
      $sql = $pdo->prepare("UPDATE users SET senha=? WHERE id=?");
      $sql->execute(array($novasenha, $user['user_id']));
      $sql = $pdo->prepare("UPDATE users_tokens SET used=1");
      $sql->execute();
      echo "Nova senha cadastrada.";
      echo '<a href="login.php">Fazer login</a><br /><br />';
      exit;
    }else{
      echo "Senhas digitadas não conferem.";
    }
    
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Nova senha</title>
</head>
<body>
  <form method="POST">
    Nova Senha: <input type="text" name="novasenha" required><br/><br/>
    Confirme a nova Senha: <input type="text" name="novasenha_confirmacao" required><br/><br/>
    <input type="submit" value="Salvar">  
  </form>
</body>
</html>