<?php
use Chronos\SimpleConfig\DirectoryConfig;

class DirectoryConfigTest extends PHPUnit_Framework_TestCase {

    /**
     * @expectedException InvalidArgumentException
     */
    public function testConstructor() {
        new DirectoryConfig("");
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testConstructor2() {
        new DirectoryConfig(null);
    }

    public function testConstructor3() {
        $config = new DirectoryConfig(__DIR__ . "/test-files/test-directory/");

        $this->assertNotNull($config);
        $this->assertEquals(array(__DIR__ . "/test-files/test-directory/app.php",
                                  __DIR__ . "/test-files/test-directory/db.php"), $config->getFiles());
    }

    public function testGet() {
        $config = new DirectoryConfig(__DIR__ . "/test-files/test-directory/");

        $value = $config->get("app.test");

        $this->assertEquals("1", $value);
    }

    public function testGet2() {
        $config = new DirectoryConfig(__DIR__ . "/test-files/test-directory/");

        $value = $config->get("db.host");

        $this->assertEquals("localhost", $value);
    }
}