<?php

namespace Services\ClassFactory;

use Services\ArmyConfigurator\ConfigureArmiesList;
use Services\ArmyConfigurator\RandomConfigurator;
use Services\ArmyGenerator\GenerateArmy;

class Factory
{
    private $classes = [
        'GenerateArmy' => GenerateArmy::class,
        'ConfigureArmiesList' => ConfigureArmiesList::class,
        'RandomConfigurator' => RandomConfigurator::class,
        ];

    public function create($className)
    {
        foreach ($this->classes as $classKey => $classValue) {
            if ($className === $classKey) {
                return new $classValue;
            }
        }
    }

}