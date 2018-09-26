<?php

namespace Services\ClassFactory;

use Services\ArmyConfigurator\ConfigureArmiesList;
use Services\ArmyConfigurator\RandomConfigurator;
use Services\ArmyGenerator\GenerateArmy;
use Services\BattleSimulator\BattleSimulator;
use Services\StrategyChooser\RandomPicker;
use Services\StrategyChooser\StrongestPicker;
use Services\StrategyChooser\WeakestPicker;

class Factory
{
    private $classes = [
        'GenerateArmy' => GenerateArmy::class,
        'ConfigureArmiesList' => ConfigureArmiesList::class,
        'RandomConfigurator' => RandomConfigurator::class,
        'BattleSimulator' => BattleSimulator::class,
        'RandomPicker' => RandomPicker::class,
        'WeakestPicker' => WeakestPicker::class,
        'StrongestPicker' => StrongestPicker::class,
        ];

    public function create(string $className)
    {
        foreach ($this->classes as $classKey => $classValue) {
            if ($className === $classKey) {
                return new $classValue;
            }
        }
    }

}