<?php
class DatabaseTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->assertTrue(true, extension_loaded('pdo'));
    }

    public function testConnection()
    {
        // var_dump(new \PDO());
        // $settings = require 'settings.php';
        // $PHPMigrate = new PHPMigrate($settings['PHPMigrate']);

        // var_dump($PHPMigrate);

        // // var_dump($PHPMigrate);
        // $this->assertObjectHasAttribute('PHPMigrate',$PHPMigrate);
    }
}