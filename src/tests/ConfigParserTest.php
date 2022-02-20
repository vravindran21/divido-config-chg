<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Config\ConfigParser;

final class ConfigParserTest extends TestCase
{
    public function testPassingIndividualKeyToGetConfig(): void
    {
        $conf = ["environment" => "UAT", "database" => ["host" => "localhost", "port" => "5503"]];
        $parser = new ConfigParser($conf);
        $this->assertSame(
            'UAT',
            $parser->getConfig('environment')
        );
    }

    public function testPassingSectionsToGetConfig(): void
    {
        $conf = ["environment" => "UAT", "database" => ["host" => "localhost", "port" => "5503"]];
        $parser = new ConfigParser($conf);
        $this->assertSame(
            'localhost',
            $parser->getConfig('database.host')
        );
    }

    public function testMultiLevelKeyToGetConfig(): void
    {
        $conf = [
            "step1" => [
                "step2" => [
                    "step3" => [
                        "step4" => [
                            "step5" => "woohoo!"
                        ]
                    ]
                ]
            ]
        ];
        $parser = new ConfigParser($conf);
        $this->assertSame(
            'woohoo!',
            $parser->getConfig('step1.step2.step3.step4.step5')
        );
    }

    public function testPassingNonExistentKeyToGetConfig(): void
    {
        $conf = ["environment" => "UAT", "database" => ["host" => "localhost", "port" => "5503"]];
        $parser = new ConfigParser($conf);
        $this->assertSame(
            null,
            $parser->getConfig('something.random')
        );
    }

    public function testPassingEmptyStringToGetConfig(): void
    {
        $conf = ["environment" => "UAT", "database" => ["host" => "localhost", "port" => "5503"]];
        $parser = new ConfigParser($conf);
        $this->assertSame(
            null,
            $parser->getConfig('')
        );
    }

    public function testPassingNullToGetConfig(): void
    {
        $conf = ["environment" => "UAT", "database" => ["host" => "localhost", "port" => "5503"]];
        $parser = new ConfigParser($conf);
        $this->assertSame(
            null,
            $parser->getConfig(null)
        );
    }
}
