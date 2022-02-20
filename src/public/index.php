<?php

require dirname(__DIR__, 1) . '/vendor/autoload.php';

use App\Config\ConfigLoad;

$config_files = [
    'config.invalid.json',  'config.json'
];

$loader = new ConfigLoad();
$config = $loader->loadConfig($config_files);

print_r($config->getConfig('environment') . "\n");
