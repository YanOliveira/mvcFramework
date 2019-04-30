<?php  
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  require('PHPMailer/src/PHPMailer.php');
  require('PHPMailer/src/Exception.php');
  require('PHPMailer/src/SMTP.php');
  require('config.php');  
  if(isset($_POST['nome']) && !empty($_POST['nome'])){
    $nome = addslashes($_POST['nome']);
    $email = addslashes($_POST['email']);            
    try{
      $sql = $pdo->prepare("SELECT * FROM users WHERE email=?");
      $sql->execute(array($email));
      if($sql->rowCount() > 0){
        echo "Email existente";        
      }else{
        $sql = $pdo->prepare("INSERT INTO users (nome, email) VALUES (?, ?)");
        $sql->execute(array($nome, $email));        
        try{      
          $mail = new PHPMailer(true);
          $mail->Host = "smtp.mailtrap.io";
          $mail->isSMTP();
          $mail->SMTPAuth = true;
          $mail->SMTPSecure = 'tls';
          $mail->Username = "7bebd593bc75d2";
          $mail->Password = "23d4b953a2f7e7";
          $mail->Port = "2525";
          $mail->isHTML(true);
          $mail->setFrom("yan@gmail.com", "Yan Oliveira");
          $mail->addAddress($email, $nome);
          $mail->Subject = "Cadastro realizado!";      
          $mail->Body = 'link de confirmação: <a href="http://localhost/projects/php/cadastroaprovacao/confirmacao.php?cod='.md5($email).'">LINK</a>';
    
          $mail->send();
    
          echo "<h2>Email com o link de confirmação enviado!</h2>";
    
        }catch(Exception $e){
          echo "Erro: ".$mail->ErrorInfo;
        }

      }      
    }catch(PDOException $e){
      echo "Erro: ".$e->getMessage();
    }    
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
<form method="POST">
  Nome: <input type="text" name="nome"> <br/><br/>
  Email: <input type="email" name="email"> <br/><br/>
  <input type="submit" value="Cadastrar">
</form>
</body>
</html>