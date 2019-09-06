<?php
namespace src\Tests;

use \PHPUnit\Framework\TestCase;

class DirectoriesTest extends TestCase
{
  public function testDirAssetsExistsAndIsReadable()
  {
    $this->assertDirectoryIsReadable('src/Assets');
  }

  public function testDirVendorExistsAndIsReadable()
  {
    $this->assertDirectoryIsReadable('vendor');
  }

  public function testDirPublicExistsAndIsReadable()
  {
    $this->assertDirectoryIsReadable('public');
  }

  public function testDirUploadsExistsAndIsWritable()
  {
    $this->assertDirectoryIsWritable('public/Uploads');
  }

  public function testDirLogsExistsAndIsWritable()
  {
    $this->assertDirectoryIsWritable('Logs');
  }
}
