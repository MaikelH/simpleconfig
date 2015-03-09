<?php
/**
 * Created by IntelliJ IDEA.
 * User: Maikel
 * Date: 3/8/2015
 * Time: 01:03
 */

namespace Chronos\SimpleConfig;


use Chronos\SimpleConfig\Exceptions\FileNotFound;
use Chronos\SimpleConfig\Exceptions\UnknownConfigurationValue;

class FileConfig implements IConfig {

    /**
     * @var String Path to the config file.
     */
    private $file;

    private $configValues;

    /**
     * Create a new configuration file with the specified file.
     *
     * @param $file string Full path to the configuration file
     * @throws FileNotFound When the config file cant be found.
     */
    public function __construct($file) {

        $this->file = $file;

        $baseName = pathinfo($file)['filename'];
        $this->configValues[$baseName] = $this->readConfigFile($file);
    }

    /**
     * @param string $path Path to the configuration file. Separated by dots.
     * @param null $default Optional default value
     * @return mixed
     * @throws UnknownConfigurationValue Thrown when there is no default value and the value is not found.
     * @throws \Exception
     */
    public function get($path, $default = null)
    {
        if($path == null) {
            throw new \Exception("Invalid argument: Path cannot be null");
        }

        $parts = explode(".", $path);
        $currentValues = $this->configValues;

        for($i = 0; $i < count($parts); $i++) {
            if(array_key_exists($parts[$i], $currentValues)) {
                $currentValues = $currentValues[$parts[$i]];
            }
            else {
                if($default !== null) {
                    $currentValues = $default;
                    break;
                }
                throw new UnknownConfigurationValue("Can not find: " . $path);
            }
        }

        return $currentValues;
    }

    /**
     * @return String Path to file that is used as config.
     */
    public function getFile() {
        return $this->file;
    }

    /**
     * Reads the config file.
     *
     * @param $file
     * @return Array Array of configuration values
     * @throws FileNotFound
     */
    private function readConfigFile($file) {
        if(!file_exists($file)) {
            throw new FileNotFound("Configuration file: {$file} not found.");
        }

        return include($file);
    }
}