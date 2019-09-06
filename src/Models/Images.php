<?php
namespace src\Models;

use \PDOException;
use \src\Core\Model;

class Images extends Model
{
  public function upload($image)
  {
    try {
      $allowedFormats = array('image/jpeg', 'image/jpg', 'image/png');
      if (!in_array($image['type'], $allowedFormats)) {
        throw new PDOException('Formato de imagem inválido');
      }

      $image['name'] = explode('.', $image['name'])[0] . '_' . md5(time() . rand(0, 999)) . '.jpg';
      if (!file_exists(BASE_DIR . "/public/Uploads")) {
        mkdir(BASE_DIR . "/public/Uploads");
      }
      move_uploaded_file(
        $image['tmp_name'], BASE_DIR . '/public/Uploads/' . $image['name']
      );
      $url = '/Uploads/' . $image['name'];
      $sql = "insert into images (name, url) values (?, ?)";
      $teste = $this->executeQuery($sql, array($image['name'], $url));
      if ($teste) {
        echo 'Enviado!';
      }
    } catch (PDOException $e) {
      echo "Erro: " . $e->getMessage();
    }
  }

  public function getAllImages()
  {
    $sql = 'select * from images';
    $data = $this->executeQuery($sql);
    return $data;
  }
}
