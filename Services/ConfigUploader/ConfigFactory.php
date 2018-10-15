<?php

namespace Services\ConfigUploader;

use Exception;
use Services\ClassFactory\Factory;
use Services\ConfigUploader\Contracts\ConfigUploaderInterface;
use Services\ConfigUploader\Strategies\JsonConfig;
use Throwable;

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
        try {
            $strategyClass = $this->strategies[$strategy];
        } catch (Throwable $exception) {
            throw new Exception("Custom Error: there is no {$strategy} strategy name in the given array");
        }
        $chosenStrategy = $this->container->create($strategyClass);

        return $chosenStrategy;
    }
}
