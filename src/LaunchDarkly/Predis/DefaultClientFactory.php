<?php

namespace LaunchDarkly\Predis;

use LaunchDarkly\LDDFeatureRequesterOptions;
use Predis\Client;

class DefaultClientFactory implements ClientFactoryInterface
{
    /**
     * @param LDDFeatureRequesterOptions $options
     * @return Client
     */
    public function createClient(LDDFeatureRequesterOptions $options)
    {
        $clientParameters = [
            'scheme' => $options->getRedisScheme(),
            'host' => $options->getRedisHost(),
            'port' => $options->getRedisPort(),
        ];

        return new Client($clientParameters);
    }
}
