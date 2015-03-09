# SimpleConfig

SimpleConfig is a configuration library for PHP. Has support for single or multiple file configurations. Aims to be a 
simple library for basic configuration needs.

## Usage

SimpleConfig can be installed via composer: [chronos/simpleconfig](https://packagist.org/packages/chronos/simpleconfig).

```PHP
$config = new FileConfig("Path/to/file");

$value = $config->get("app.host");
```