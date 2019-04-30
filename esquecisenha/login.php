<?php
session_start();
if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
  header('Location: index.php');
}
require('config.php');
if (!empty($_POST['email']) && !empty($_POST['senha'])) {
  try {
    $email = addslashes($_POST['email']);
    $senha = md5(addslashes($_POST['senha']));
    $sql = $pdo->prepare("SELECT * from users WHERE email=? AND senha=?");
    $sql->execute(array($email, $senha));
    if ($sql->rowCount() > 0) {
      $user = $sql->fetch();
      $_SESSION['user'] = $user['id'];
      header('Location: index.php');
    } else {
      echo "Email ou senha incorretos..";
    }
  } catch (Exception $e) {
    echo "Erro ao fazer Login.";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
</head>

<body>
  <form method="POST">
    Email: <input type="email" name="email"><br /><br />
    Senha: <input type="password" name="senha"><br /><br />
    <input type="submit" value="Entrar"><br /><br />
  </form>
  <a href="esqueci.php">Recuperar senha</a><br />
  <a href="cadastrar.php">Cadastre-se</a><br /><br />
</body>

</html>