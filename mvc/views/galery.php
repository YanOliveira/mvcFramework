<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <fieldset>
  <form action="" method="POST" enctype='multipart/form-data'>
    <input type="file" name='image'>
    <input type="submit" value="Enviar">
  </form>
  </fieldset>

  <br><br>

  <?php
if (!empty($images)) {
    foreach ($images as $image) {?>
        <img width='100' src="<?=BASE_URL . $image['url'];?>" title="<?=$image['name'];?>">
        <br>
      <?php }
}
?>
</body>
</html>