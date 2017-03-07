<?php
class DatabaseTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
        $this->assertTrue(true, extension_loaded('pdo'));
    }
}