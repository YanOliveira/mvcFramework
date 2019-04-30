<?php
  session_start();
  require('config.php');

  if(!isset($_SESSION['banco']) || empty($_SESSION['banco'])){
    header('Location: login.php');
    exit;
  }
  
  $conta_id = $_SESSION['banco'];  
  $sql = $pdo->prepare("SELECT * FROM contas WHERE id = ?");  
  $sql->execute(array($conta_id));

  if($sql->rowCount() >0){
    $info = $sql->fetch();
  }else{
    header('Location: login.php');
    exit;
  }

  $sql = $pdo->prepare("SELECT * FROM movimentacoes WHERE conta_id = ?");  
  $sql->execute(array($conta_id));
  if($sql->rowCount()>0){
    $movimentacoes = $sql->fetchAll();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Caixa eletronico</title>
</head>
<body>
  <h1>Banco XYZ</h1>
  Titular: <?=$info['nome'] ?><br/>
  Agência: <?=$info['agencia'] ?><br/>
  Conta: <?=$info['conta'] ?><br/>
  Saldo: <?=$info['saldo'] ?><br/>
  <a href="sair.php">Sair</a>
  <hr/>
  
  <h3>Extrato:</h3>
  <a href="transacao.php">Adicionar transação</a><br/><br/>


  <?php
        if(isset($movimentacoes) && count($movimentacoes) > 0){
  ?>
          <table border="1" width="400">
            <tr>
              <th>Data</th>
              <th>Valor</th>
            </tr>
                <?php
                foreach($movimentacoes as $movimentacao){
                ?>
                  <tr>
                    <td>
                      <?=date("d/m/Y - H:i", strtotime($movimentacao['data']));?>
                    </td>
                    <td>
                      <?= ($movimentacao['tipo'] == 1) ? 
                        '<font color="green">+ R$ ' : 
                        '<font color="red">- R$ ';
                        echo $movimentacao['valor']."</font>";
                      ?>                                        
                    </td>
                  </tr>
                <?php
                }
                ?>                          
          </table>
        <?php
        }else{
          echo "Sem movimentações.";
        }        
      ?>  
</body>
</html>