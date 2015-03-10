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

class FileConfig extends AbstractConfig {

    /**
     * @var String Path to the config file.
     */
    private $file;

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