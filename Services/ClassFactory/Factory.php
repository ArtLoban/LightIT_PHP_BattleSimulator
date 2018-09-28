<?php

namespace Services\ClassFactory;

use Exception;
use Services\ArmyConfigurator\ConfigureArmiesList;
use Services\ArmyConfigurator\RandomConfigurator;
use Services\ArmyGenerator\GenerateArmy;
use Services\BattleSimulator\BattleMaster;
use Services\BattleSimulator\BattleSimulator;
use Services\BubbleSorter\BubbleSorter;
use Services\StrategyChooser\RandomPicker;
use Services\StrategyChooser\StrongestPicker;
use Services\StrategyChooser\WeakestPicker;

class Factory
{
    /**
     * @var array
     */
    private $classes = [
        'GenerateArmy' => GenerateArmy::class,
        'ConfigureArmiesList' => ConfigureArmiesList::class,
        'RandomConfigurator' => RandomConfigurator::class,
        'BattleSimulator' => BattleSimulator::class,
        'RandomPicker' => RandomPicker::class,
        'WeakestPicker' => WeakestPicker::class,
        'StrongestPicker' => StrongestPicker::class,
        'BubbleSorter' => BubbleSorter::class,
        'BattleMaster' => BattleMaster::class,
        ];

    /**
     * @param string $className
     * @return object
     */
    public function create(string $className): object
    {
        if (!array_key_exists($className, $this->classes)) {
            throw new Exception("Custom Error: there is no {$className} class name in the given array");
        }

        $classInstance = new $this->classes[$className];

        return $classInstance;
    }

}