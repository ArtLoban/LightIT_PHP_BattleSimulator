<?php

namespace Services\ArmyConfigurator;

use Exception;
use Services\ArmyConfigurator\Contracts\ConfiguratorInterface;
use Services\ArmyConfigurator\Strategies\FromConfigCollector;
use Services\ArmyConfigurator\Strategies\RandomCollector;
use Services\ClassFactory\Factory;
use Throwable;

class ConfigurationFactory
{
    /**
     * @var Factory
     */
    private $container;

    /**
     * @var array
     */
    private $strategies = [
        'randomCollector' => RandomCollector::class,
        'fromConfigCollector' => FromConfigCollector::class,
    ];

    /**
     * ConfigurationFactory constructor.
     * @param Factory $container
     */
    public function __construct(Factory $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $strategy
     * @return ConfiguratorInterface
     */
    public function getConfigurator(string $strategy): ConfiguratorInterface
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
