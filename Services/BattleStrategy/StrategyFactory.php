<?php

namespace Services\BattleStrategy;

use Services\BattleStrategy\Contracts\StrategyInterface;
use Services\BattleStrategy\Strategies\Random;
use Services\BattleStrategy\Strategies\Strongest;
use Services\BattleStrategy\Strategies\Weakest;
use Services\ClassFactory\Factory;

class StrategyFactory
{
    /**
     * @var Factory
     */
    private $container;

    /**
     * @var array
     */
    private $strategies = [
        'random' => Random::class,
        'weakest' => Weakest::class,
        'strongest' => Strongest::class,
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
     * @return StrategyInterface
     */
    public function buildStrategy(string $strategy): StrategyInterface
    {
        $className = $this->strategies[$strategy];
        $strategy = $this->container->create($className);

        return $strategy;
    }

}