<?php

namespace Services\ConfigUploader;

use Services\ClassFactory\Factory;
use Services\ConfigUploader\Contracts\ConfigUploaderInterface;
use Services\ConfigUploader\Strategies\JsonConfig;

class ConfigFactory
{
    /**
     * @var Factory
     */
    private $container;

    /**
     * @var array
     */
    private $strategies = [
        'JsonConfig' => JsonConfig::class,
    ];

    /**
     * ConfigFactory constructor.
     * @param Factory $container
     */
    public function __construct(Factory $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $strategy
     * @return ConfigUploaderInterface
     */
    public function get(string $strategy): ConfigUploaderInterface
    {
        $strategyClass = $this->strategies[$strategy];

        return $this->container->create($strategyClass);
    }
}
