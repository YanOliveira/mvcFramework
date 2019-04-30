<?php
session_start();
if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
  header('Location: index.php');
}
require('config.php');

if (isset($_POST['email']) && !empty($_POST['email'])) {
  $email = addslashes($_POST['email']);
  $sql = $pdo->prepare('SELECT * FROM users WHERE email=?');
  $sql->execute(array($email));
  $user = $sql->fetch();
  if ($sql->rowCount() <= 0) {
    echo "Email não cadastrado.";
    echo '<a href="esqueci.php">Voltar</a><br /><br />';
    exit;
  } else {
      try {
        $sql = $pdo->prepare("INSERT INTO users_tokens (user_id, token, used) VALUES (?, ?, ?)");
        $token = md5($user['id'] . $user['email']);
        $sql->execute(array($user['id'], $token, 0));

        $mail->setFrom('yan@suporte.com', 'Yan Oliveira');
        $mail->addAddress($user['email'], $user['nome']);
        $mail->Subject = 'Recuperação de senha';
        $mail->Body    = '<a href="http://localhost/projects/php/esquecisenha/recuperacao.php?token=' . $token . '">Clique aqui</a> para cadastrar nova senha.';
        $mail->Send();
        echo "Um email foi enviado!";
      } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
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
  <title>Esqueci</title>
</head>

<body>
  <form method="POST">
    Email: <input type="email" name="email" required><br /><br />
    <input type="submit" value="Recuperar"><br /><br />
  </form>
  <a href="login.php">Voltar</a><br /><br />
</body>

</html>