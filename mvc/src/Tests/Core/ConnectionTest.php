<?php
namespace src\Tests\Core;

use \PHPUnit\Framework\TestCase;
use \src\Core\Connection;

require __DIR__ . "/../../Config/constants.php";

class ConnectionTest extends TestCase
{
  public function testAttributePdoExists()
  {
    $this->assertClassHasStaticAttribute('pdo', Connection::class);
  }
  public function testGetInstanceReturns()
  {
    $this->assertNotEmpty(Connection::getInstance());
  }
}
