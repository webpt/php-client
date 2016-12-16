<?php

namespace LaunchDarkly;

use LaunchDarkly\Predis\ClientFactoryInterface;
use LaunchDarkly\Predis\ClientOptions;
use LaunchDarkly\Predis\DefaultClientFactory;
use Zend\Stdlib\AbstractOptions;

class LDDFeatureRequesterOptions extends AbstractOptions
{
    /** @var ClientFactoryInterface|string */
    private $redisClientFactory = DefaultClientFactory::class;

    /** @var string */
    private $redisScheme = 'tcp';

    /** @var string */
    private $redisHost = 'localhost';

    /** @var int */
    private $redisPort = 6379;

    /** @var string */
    private $redisPrefix = 'launchdarkly';

    /** @var array */
    private $redisSentinels = [];

    /** @var ClientOptions|array */
    private $redisOptions = [];

    /**
     * LDDFeatureRequesterOptions constructor.
     * @param array|\Traversable $options
     */
    public function __construct($options = null)
    {
        // Disable strict mode, since the feature-requester options are a subset of LaunchDarkly client options.
        $this->__strictMode__ = false;

        parent::__construct($options);
    }

    /**
     * @return ClientFactoryInterface
     */
    public function getRedisClientFactory()
    {
        if (!$this->redisClientFactory instanceof ClientFactoryInterface) {
            $this->redisClientFactory = new $this->redisClientFactory;
        }

        return $this->redisClientFactory;
    }

    /**
     * @param ClientFactoryInterface|string $redisClientFactory
     * @return void
     */
    public function setRedisClientFactory($redisClientFactory)
    {
        $this->redisClientFactory = $redisClientFactory;
    }

    /**
     * @return string
     */
    public function getRedisScheme()
    {
        return $this->redisScheme;
    }

    /**
     * @param string $redisScheme
     * @return void
     */
    public function setRedisScheme($redisScheme)
    {
        $this->redisScheme = $redisScheme;
    }

    /**
     * @return string
     */
    public function getRedisHost()
    {
        return $this->redisHost;
    }

    /**
     * @param string $redisHost
     * @return void
     */
    public function setRedisHost($redisHost)
    {
        $this->redisHost = $redisHost;
    }

    /**
     * @return int
     */
    public function getRedisPort()
    {
        return $this->redisPort;
    }

    /**
     * @param int $redisPort
     * @return void
     */
    public function setRedisPort($redisPort)
    {
        $this->redisPort = $redisPort;
    }

    /**
     * @return string
     */
    public function getRedisPrefix()
    {
        return $this->redisPrefix;
    }

    /**
     * @param string $redisPrefix
     * @return void
     */
    public function setRedisPrefix($redisPrefix)
    {
        $this->redisPrefix = $redisPrefix;
    }

    /**
     * @return array
     */
    public function getRedisSentinels()
    {
        return $this->redisSentinels;
    }

    /**
     * @param array $redisSentinels
     * @return void
     */
    public function setRedisSentinels($redisSentinels)
    {
        $this->redisSentinels = $redisSentinels;
    }

    /**
     * @return ClientOptions
     */
    public function getRedisOptions()
    {
        if (is_array($this->redisOptions)) {
            $this->redisOptions = new ClientOptions($this->redisOptions);
        }

        return $this->redisOptions;
    }

    /**
     * @param array $redisOptions
     * @return void
     */
    public function setRedisOptions(array $redisOptions)
    {
        $this->redisOptions = $redisOptions;
    }
}
