<?php

namespace LaunchDarkly\Tests\Predis;

use LaunchDarkly\LDDFeatureRequesterOptions;
use LaunchDarkly\Predis\DefaultClientFactory;
use Predis\Client;

/**
 * @covers \LaunchDarkly\Predis\DefaultClientFactory
 */
class DefaultClientFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateClient()
    {
        $options = new LDDFeatureRequesterOptions();
        $factory = new DefaultClientFactory();

        $client = $factory->createClient($options);
        self::assertInstanceOf(Client::class, $client);
    }
}
