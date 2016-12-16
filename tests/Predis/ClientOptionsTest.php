<?php

namespace LaunchDarkly\Tests\Predis;

use LaunchDarkly\Predis\ClientOptions;

/**
 * @covers \LaunchDarkly\Predis\ClientOptions
 */
class ClientOptionsTest extends \PHPUnit_Framework_TestCase
{
    public function testGetDefaultReplication()
    {
        $options = new ClientOptions([

        ]);

        self::assertEquals('sentinel', $options->getReplication());
    }

    public function testSetReplication()
    {
        $options = new ClientOptions([
            'replication' => 'test',
        ]);

        self::assertEquals('test', $options->getReplication());
    }

    public function testGetDefaultService()
    {
        $options = new ClientOptions([

        ]);

        self::assertEquals('mymaster', $options->getService());
    }

    public function testSetService()
    {
        $options = new ClientOptions([
            'service' => 'test',
        ]);

        self::assertEquals('test', $options->getService());
    }
}
