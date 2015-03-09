<?php
/**
 * User: Maikel
 * Date: 3/8/2015
 */
$loader = require __DIR__ . "/../vendor/autoload.php";
$loader->addPsr4('Chronos\\', __DIR__.'/Chronos');

date_default_timezone_set('UTC');