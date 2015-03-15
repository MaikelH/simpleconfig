<?php
/**
 * Created by IntelliJ IDEA.
 * User: Maikel
 * Date: 3/10/2015
 * Time: 23:22
 */

namespace Chronos\SimpleConfig;


/**
 * Class DirectoryConfig
 *
 * Reads all the files in a directory that match the specified pattern and use them as config files.
 *
 * @package Chronos\SimpleConfig
 */
class DirectoryConfig extends AbstractConfig{

    private $files = array();

    /**
     * Construct a new DirectoryConfig object.
     *
     * @param string $directory
     * @param string $pattern
     */
    public function __construct($directory, $pattern = "*.php") {
        if($directory == null || $directory === "") {
            throw new \InvalidArgumentException("Invalid directory specified: " . $directory);
        }

        $this->files = $this->getFilenames($directory, $pattern);
        $this->configValues = $this->readFiles($this->files);
    }

    /**
     * Retrieve all the files that are included in this configuration object.
     *
     * @return array
     */
    public function getFiles() {
        return $this->files;
    }

    /**
     * Retrieve all the files matching a pattern from the directory.
     *
     * @param $directory string
     * @param $pattern string
     * @return array Array of files
     */
    private function getFilenames($directory, $pattern)
    {
        $lastchar = substr($directory, -1);
        if($lastchar !== '/' && !$lastchar !== '\\') {
            $directory .= '/';
        }

        return glob($directory . $pattern);
    }

    /**
     * Reads the files and returns the array.
     *
     * @param $files array Files to be read
     * @return array
     */
    private function readFiles($files) {
        $return = array();

        foreach($files as $file) {
            $key = pathinfo($file)['filename'];

            $return[$key] = include($file);
        }

        return $return;
    }
}