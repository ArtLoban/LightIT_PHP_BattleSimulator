<?php

namespace Services\ArmyConfigurator;

use Services\ArmyConfigurator\Contracts\ConfiguratorInterface;
use Services\ArmyConfigurator\Strategies\RandomCollector;
use Services\ClassFactory\Factory;

class ConfigureStrategy
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
    ];

    /**
     * StrategyFactory constructor.
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
        $strategyClass = $this->strategies[$strategy];
        $chosenStrategy = $this->container->create($strategyClass);

        return $chosenStrategy;
    }

}