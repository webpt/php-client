<?php

namespace LaunchDarkly\Tests;

use LaunchDarkly\LDDFeatureRequesterOptions;
use LaunchDarkly\Predis\ClientFactoryInterface;
use LaunchDarkly\Predis\ClientOptions;
use LaunchDarkly\Predis\DefaultClientFactory;

/**
 * @covers \LaunchDarkly\LDDFeatureRequesterOptions
 */
class LDDFeatureRequesterOptionsTest extends \PHPUnit_Framework_TestCase
{
    public function testGetDefaultClientFactory()
    {
        $options = new LDDFeatureRequesterOptions([

        ]);

        self::assertInstanceOf(DefaultClientFactory::class, $options->getRedisClientFactory());
    }

    public function testSetClientFactory()
    {
        $options = new LDDFeatureRequesterOptions([
            'redis_client_factory' => $this->getMockBuilder(ClientFactoryInterface::class)->getMock(),
        ]);

        self::assertInstanceOf(ClientFactoryInterface::class, $options->getRedisClientFactory());
    }

    public function testGetDefaultScheme()
    {
        $options = new LDDFeatureRequesterOptions([

        ]);

        self::assertEquals('tcp', $options->getRedisScheme());
    }

    public function testSetScheme()
    {
        $options = new LDDFeatureRequesterOptions([
            'redis_scheme' => 'http',
        ]);

        self::assertEquals('http', $options->getRedisScheme());
    }

    public function testGetDefaultHost()
    {
        $options = new LDDFeatureRequesterOptions([

        ]);

        self::assertEquals('localhost', $options->getRedisHost());
    }

    public function testSetHost()
    {
        $options = new LDDFeatureRequesterOptions([
            'redis_host' => '127.0.0.1',
        ]);

        self::assertEquals('127.0.0.1', $options->getRedisHost());
    }

    public function testGetDefaultPort()
    {
        $options = new LDDFeatureRequesterOptions([

        ]);

        self::assertEquals(6379, $options->getRedisPort());
    }

    public function testSetPort()
    {
        $options = new LDDFeatureRequesterOptions([
            'redis_port' => 1234,
        ]);

        self::assertEquals(1234, $options->getRedisPort());
    }

    public function testGetDefaultPrefix()
    {
        $options = new LDDFeatureRequesterOptions([

        ]);

        self::assertEquals('launchdarkly', $options->getRedisPrefix());
    }

    public function testSetPrefix()
    {
        $options = new LDDFeatureRequesterOptions([
            'redis_prefix' => 'LD_',
        ]);

        self::assertEquals('LD_', $options->getRedisPrefix());
    }

    public function testGetDefaultSentinels()
    {
        $options = new LDDFeatureRequesterOptions([

        ]);

        self::assertCount(0, $options->getRedisSentinels());
    }

    public function testSetSentinels()
    {
        $options = new LDDFeatureRequesterOptions([
            'redis_sentinels' => [
                'tcp://localhost',
            ],
        ]);

        self::assertNotCount(0, $options->getRedisSentinels());
    }

    public function testGetDefaultOptions()
    {
        $options = new LDDFeatureRequesterOptions([

        ]);

        self::assertInstanceOf(ClientOptions::class, $options->getRedisOptions());
    }

    public function testSetOptions()
    {
        $options = new LDDFeatureRequesterOptions([
            'redis_options' => [
                'service' => 'test',
            ],
        ]);

        self::assertInstanceOf(ClientOptions::class, $options->getRedisOptions());
        self::assertEquals('test', $options->getRedisOptions()->getService());
    }
}
