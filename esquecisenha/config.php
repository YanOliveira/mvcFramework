<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require('PHPMailer/src/Exception.php');
require('PHPMailer/src/PHPMailer.php');
require('PHPMailer/src/SMTP.php');

define("DSN", "mysql:dbname=esqueci;host=localhost");
define("DB_USER", "root");
define("DB_PASS", "root");

define("MAIL_HOST", "smtp.mailtrap.io");
define("MAIL_USER", "7bebd593bc75d2");
define("MAIL_PASS", "23d4b953a2f7e7");
define("MAIL_PORT", 25);

try {
  $pdo = new PDO(DSN, DB_USER, DB_PASS);
} catch (PDOException $e) {
  echo "Erro DB: " . $e->getMessage();
}

$mail = new PHPMailer(true);
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Host       = MAIL_HOST;
$mail->Username   = MAIL_USER;
$mail->Password   = MAIL_PASS;
$mail->Port       = MAIL_PORT;
$mail->isHTML(true);
