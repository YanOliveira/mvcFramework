<?php
namespace src\Tests;

use \PHPUnit\Framework\TestCase;

class FilesTest extends TestCase
{
  public function testFileIndexExistsAndIsReadable()
  {
    $this->assertFileIsReadable('index.php');
  }
  public function testFileComposerExistsAndIsReadable()
  {
    $this->assertFileIsReadable('composer.json');
  }
  public function testFileHtaccessExistsAndIsReadable()
  {
    $this->assertFileIsReadable('.htaccess');
  }
  public function testFileRoutesExistsAndIsReadable()
  {
    $this->assertFileIsReadable('src/Config/routes.php');
  }
  public function testFileConstantsExistsAndIsReadable()
  {
    $this->assertFileIsReadable('src/Config/constants.php');
  }

}
