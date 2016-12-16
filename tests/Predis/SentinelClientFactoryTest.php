<?php

namespace LaunchDarkly\Tests\Predis;

use LaunchDarkly\LDDFeatureRequesterOptions;
use LaunchDarkly\Predis\SentinelClientFactory;
use Predis\Client;

/**
 * @covers \LaunchDarkly\Predis\SentinelClientFactory
 */
class SentinelClientFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateClient()
    {
        $options = new LDDFeatureRequesterOptions();
        $factory = new SentinelClientFactory();

        $client = $factory->createClient($options);
        self::assertInstanceOf(Client::class, $client);
    }
}
