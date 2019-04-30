<?php
session_start();
if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
  header('Location: index.php');
}
require('config.php');
if (!empty($_POST['email']) && !empty($_POST['nome']) && !empty($_POST['senha']) && !empty($_POST['senha_confirmacao'])) {
  $nome = addslashes($_POST['nome']);
  $email = addslashes($_POST['email']);
  if ($_POST['senha'] !== $_POST['senha_confirmacao']) {
    echo "Senhas digitadas não conferem";
  } else {
    $senha = md5(addslashes($_POST['senha']));
    try {
      $sql = $pdo->prepare("INSERT INTO users (nome, email, senha) VALUES (?, ?, ?)");
      $sql->execute(array($nome, $email, $senha));
      echo "Cadastrado! <a href='login.php'>Fazer Login.</a>";
      exit;
    } catch (Exception $e) {
      echo "Erro ao cadastrar";
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Cadastrar</title>
</head>

<body>
  <form method="POST">
    Nome: <input type="text" name="nome" required><br /><br />
    Email: <input type="email" name="email" required><br /><br />
    Senha: <input type="password" name="senha" required><br /><br />
    Confirmação da senha: <input type="password" required name="senha_confirmacao"><br /><br />
    <input type="submit" value="Cadastrar"><br /><br />
  </form>
  <a href="login.php">Já possuo uma conta</a><br /><br />
</body>

</html>