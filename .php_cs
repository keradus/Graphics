<?php

use Symfony\CS\Config\Config;

$config = Config::create()
    // use default level and extra fixers:
    ->fixers(array(
        '-concat_without_spaces',
        '-psr0',
        'concat_with_spaces',
        'ordered_use',
        'short_array_syntax',
        'strict',
        'strict_param',
    ))
    ->setUsingCache(true)
    ->setUsingLinter(false);

$config->getFinder()
    ->notPath('src/ExtLib.php')
    ->in(__DIR__);

return $config;
