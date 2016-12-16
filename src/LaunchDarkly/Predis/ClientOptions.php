<?php

namespace LaunchDarkly\Predis;

use Zend\Stdlib\AbstractOptions;

class ClientOptions extends AbstractOptions
{
    /** @var string */
    private $replication = 'sentinel';

    /** @var string */
    private $service = 'mymaster';

    /**
     * ClientOptions constructor.
     * @param array|\Traversable $options
     */
    public function __construct($options = null)
    {
        // Disable strict mode, since the feature-requester options are a subset of LaunchDarkly client options.
        $this->__strictMode__ = false;

        parent::__construct($options);
    }

    /**
     * @return string
     */
    public function getReplication()
    {
        return $this->replication;
    }

    /**
     * @param string $replication
     * @return void
     */
    public function setReplication($replication)
    {
        $this->replication = $replication;
    }

    /**
     * @return string
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param string $service
     * @return void
     */
    public function setService($service)
    {
        $this->service = $service;
    }
}
