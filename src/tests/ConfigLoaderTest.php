<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Config\ConfigLoad;

final class ConfigLoaderTest extends TestCase
{
    public function testExtractingConfigFromValidFile(): void
    {
        $configLoader = new ConfigLoad();
        $config = $configLoader->loadConfig(['config.json']);
        $this->assertSame(
            'production',
            $config->getConfig('environment')
        );
    }

    public function testExtractingConfigFromInvalidFile(): void
    {
        $configLoader = new ConfigLoad();
        $config = $configLoader->loadConfig(['config.invalid.json']);
        $this->assertSame(
            null,
            $config->getConfig('test')
        );
    }

    public function testExtractingConfigFromNonExistingFile(): void
    {
        $configLoader = new ConfigLoad();
        $config = $configLoader->loadConfig(['file-non-exist.json']);
        $this->assertSame(
            null,
            $config->getConfig('test')
        );
    }

    public function testLaterOverrideEarlierConfig(): void
    {
        $configLoader = new ConfigLoad();
        $config = $configLoader->loadConfig(['config.json', 'config.local.json']);
        $this->assertSame(
            'development',
            $config->getConfig('environment')
        );
    }
}
