<?php
/**
 * Created by IntelliJ IDEA.
 * User: Maikel
 * Date: 3/8/2015
 * Time: 01:06
 */

namespace Chronos\SimpleConfig;


interface IConfig {

    /**
     * Retrieve a configuration value. Path is in example:
     *
     * app.database.host
     *
     * @param $path string Path of the configuration value.
     * @param null $default Optional default value
     * @return mixed
     */
    public function get($path, $default = null);

    /**
     * Set a configuration value.
     *
     * @param $path string Full path to the configuration file
     * @param $value mixed Value to insert
     */
    public function set($path, $value);
}