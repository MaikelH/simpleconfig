<?php
/**
 * Created by IntelliJ IDEA.
 * User: Maikel
 * Date: 3/10/2015
 * Time: 20:47
 */

namespace Chronos\SimpleConfig;


use Chronos\SimpleConfig\Exceptions\UnknownConfigurationValue;

class AbstractConfig implements IConfig
{

    protected $configValues = [];

    /**
     * @param string $path Path to the configuration file. Separated by dots.
     * @param null $default Optional default value
     * @return mixed
     * @throws UnknownConfigurationValue Thrown when there is no default value and the value is not found.
     * @throws \Exception
     */
    public function get($path, $default = null)
    {
        if ($path == null) {
            throw new \Exception("Invalid argument: Path cannot be null");
        }

        $parts = explode(".", $path);
        $currentValues = $this->configValues;
        $partCount = count($parts);

        for ($i = 0; $i < $partCount; $i++) {
            if (array_key_exists($parts[$i], $currentValues)) {
                $currentValues = $currentValues[$parts[$i]];
            } else {
                if ($default !== null) {
                    $currentValues = $default;
                    break;
                }
                throw new UnknownConfigurationValue("Can not find: " . $path);
            }
        }

        return $currentValues;
    }

    /**
     * Set a configuration value.
     *
     * @param $path string Full path to the configuration file
     * @param $value mixed Value to insert
     */
    public function set($path, $value)
    {
        $parts = explode(".", $path);

        $currentValues =& $this->configValues;

        foreach ($parts as $pathsegment) {
            if (isset($currentValues[$pathsegment])) {
                $currentValues =& $currentValues[$pathsegment];
            } else {
                $currentValues[$pathsegment] = array();
                $currentValues =& $currentValues[$pathsegment];
            }
        }

        $currentValues = $value;
    }
}