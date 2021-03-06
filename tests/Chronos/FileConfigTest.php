<?php
use Chronos\SimpleConfig\FileConfig;


class FileConfigTest extends PHPUnit_Framework_TestCase{

    public function testConstruction() {
        $config = new FileConfig(__DIR__ . "/test-files/test-config1.php");

        $this->assertEquals(__DIR__ . "/test-files/test-config1.php", $config->getFile());
    }

    /**
     * @expectedException Chronos\SimpleConfig\Exceptions\FileNotFound
     */
    public function testWrongFile() {
        new FileConfig("test.php");
    }

    public function testGetFunction() {
        $config = new FileConfig(__DIR__ . "/test-files/test-config1.php");

        $value = $config->get("test-config1.test");

        $this->assertEquals("1", $value);
    }

    /**
     * @expectedException Chronos\SimpleConfig\Exceptions\UnknownConfigurationValue
     */
    public function testGetFunction2() {
        $config = new FileConfig(__DIR__ . "/test-files/test-config1.php");

        $value = $config->get("test-config1.test2");

        $this->assertEquals("1", $value);
    }

    public function testGetFunction3() {
        $config = new FileConfig(__DIR__ . "/test-files/test-config1.php");

        $value = $config->get("test-config1.test2", "2");

        $this->assertEquals("2", $value);
    }

    public function testGetFunction4() {
        $config = new FileConfig(__DIR__ . "/test-files/test-config1.php");

        $value = $config->get("test-config1.array");

        $this->assertEquals(array("host" => "Unknown"), $value);
    }

    public function testSetFunction() {
        $config = new FileConfig(__DIR__ . "/test-files/test-config1.php");

        $config->set("test-config1.host", 2);

        $this->assertEquals(2, $config->get("test-config1.host"));
    }

    public function testSetFunction2() {
        $config = new FileConfig(__DIR__ . "/test-files/test-config1.php");

        $config->set("db.host", "localhost");

        $this->assertEquals("localhost", $config->get("db.host"));
    }

    public function testSetFunction3() {
        $config = new FileConfig(__DIR__ . "/test-files/test-config1.php");

        $config->set("db.host", "localhost");
        $value = $config->get("test-config1.test2", "2");

        $this->assertEquals("localhost", $config->get("db.host"));
        $this->assertEquals("2", $value);
    }
}