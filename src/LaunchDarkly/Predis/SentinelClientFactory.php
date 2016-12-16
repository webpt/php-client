<?php

namespace LaunchDarkly\Predis;

use LaunchDarkly\LDDFeatureRequesterOptions;
use Predis\Client;

class SentinelClientFactory implements ClientFactoryInterface
{
    /**
     * @param LDDFeatureRequesterOptions $options
     * @return Client
     */
    public function createClient(LDDFeatureRequesterOptions $options)
    {
        $clientParameters = $options->getRedisSentinels();
        $clientOptions = $options->getRedisOptions();

        return new Client($clientParameters, [
            'replication' => $clientOptions->getReplication(),
            'service' => $clientOptions->getService(),
        ]);
    }
}
