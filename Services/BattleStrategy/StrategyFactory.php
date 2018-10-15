<?php

namespace Services\BattleStrategy;

use Exception;
use Services\BattleStrategy\Contracts\StrategyInterface;
use Services\BattleStrategy\Strategies\Random;
use Services\BattleStrategy\Strategies\Strongest;
use Services\BattleStrategy\Strategies\Weakest;
use Services\ClassFactory\Factory;
use Throwable;

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
        try {
            $strategyClass = $this->strategies[$strategy];
        } catch (Throwable $exception) {
            throw new Exception("Custom Error: there is no {$strategy} strategy name in the given array");
        }
        $chosenStrategy = $this->container->create($strategyClass);

        return $chosenStrategy;
    }
}
