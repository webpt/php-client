<?php

namespace LaunchDarkly\Predis;

use LaunchDarkly\LDDFeatureRequesterOptions;
use Predis\Client;

interface ClientFactoryInterface
{
    /**
     * @param LDDFeatureRequesterOptions $options
     * @return Client
     */
    public function createClient(LDDFeatureRequesterOptions $options);
}
