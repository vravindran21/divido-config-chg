<?php

declare(strict_types=1);

namespace App\Config;

class ConfigParser
{

    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function getConfig($key, $default = null)
    {
        if (is_null($key))
            return $default;

        if (isset($this->config[$key])) return $this->config[$key];

        $value = $this->config;
        foreach (explode('.', $key) as $seg) {
            if (!array_key_exists($seg, $value)) {
                $value = $default;
                break;
            }
            $value = $value[$seg];
        }
        return $value;
    }
}
