<?php

declare(strict_types=1);

namespace App\Config;

class ConfigLoad
{
    private $config = [];

    public function __construct()
    {
    }

    public function loadConfig($configFiles)
    {

        foreach ($configFiles as $file) {
            $filepath = dirname(__FILE__, 3) . '/fixtures/' . $file;

            $content = null;
            if (file_exists($filepath)) {
                $content = $this->extractConfig(file_get_contents($filepath));
            }

            if ($content) {
                $this->config = $this->mergeConfigs($this->config, $content);
            }
        }

        return new ConfigParser($this->config);
    }

    private function extractConfig($contents)
    {
        $parsed_json = json_decode($contents, true);
        return $parsed_json ?: [];
    }

    private function mergeConfigs($existing_config, $new_config)
    {
        return array_merge($existing_config, $new_config);
    }
}
