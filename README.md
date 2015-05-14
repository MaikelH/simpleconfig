# SimpleConfig 

[![Build Status](https://travis-ci.org/MaikelH/simpleconfig.svg?branch=master)](https://travis-ci.org/MaikelH/simpleconfig)[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/MaikelH/simpleconfig/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/MaikelH/simpleconfig/?branch=master)

SimpleConfig is a configuration library for PHP. Has support for single or multiple file configurations. Aims to be a 
simple library for basic configuration needs.

## Usage

SimpleConfig can be installed via composer: [chronos/simpleconfig](https://packagist.org/packages/chronos/simpleconfig).

```PHP
$config = new FileConfig("Path/to/file");

$value = $config->get("app.host");
```