<?php
session_start();
if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
  header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Dashboard</title>
</head>

<body>
  <h1>Logado!</h1>
  <a href="logout.php">Sair</a><br />
</body>

</html>