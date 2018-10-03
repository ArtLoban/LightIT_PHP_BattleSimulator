<?php

namespace Services\ClassFactory;

use App\SimulatorController;
use Exception;
use Services\ArmyConfigurator\ConfigureStrategy;
use Services\ArmyGenerator\GenerateArmy;
use Services\BattleLogger\BattleLogger;
use Services\BattleSimulator\BattleMaster;
use Services\BattleSimulator\BattleSimulator;
use Services\BattleStrategy\Strategies\Strongest;
use Services\BattleStrategy\Strategies\Weakest;
use Services\BattleStrategy\StrategyFactory;
use Services\ClassFactory\Units\ArmyFactory;
use Services\ClassFactory\Units\SquadFactory;
use Services\ClassFactory\Units\Strategies\SoldierFactory;
use Services\ClassFactory\Units\Strategies\VehicleFactory;
use Services\ClassFactory\Units\UnitBuildingStrategy;
use Services\ConfigUploader\ConfigUploader;
use Services\Sorter\SquadSorter;
use Throwable;

class Factory
{
    /**
     * @var array
     */
    private $classes = [
        SimulatorController::class => [
            GenerateArmy::class,
            BattleSimulator::class,
            ConfigUploader::class,
            ConfigureStrategy::class,
            BattleLogger::class,
        ],
        ConfigureStrategy::class => [self::class],
        GenerateArmy::class => [ArmyFactory::class],
        ArmyFactory::class => [SquadFactory::class],
        SquadFactory::class => [UnitBuildingStrategy::class],
        VehicleFactory::class => [SoldierFactory::class],
        BattleSimulator::class => [BattleMaster::class, StrategyFactory::class, BattleLogger::class],
        StrategyFactory::class => [self::class],
        Weakest::class => [SquadSorter::class],
        Strongest::class => [SquadSorter::class],
        UnitBuildingStrategy::class => [self::class],
        BattleMaster::class => [BattleLogger::class],
    ];

    /**
     * @param string $className
     * @return object
     */
    public function create(string $className): object
    {
        return isset($this->classes[$className])
            ? $this->createClassWithParams($className, $this->classes[$className])
            : $this->createInstance($className);
    }

    private function createClassWithParams(string $className, array $params)
    {
        $paramsInstances = [];
        foreach ($params as $paramClassName) {
            $paramsInstances[] = $this->create($paramClassName);
        }

        return $this->createInstance($className, $paramsInstances);
    }

    private function createInstance(string $className, array $paramsInstances = [])
    {
        try {
            return new $className(... $paramsInstances);
        } catch (Throwable $exception) {
            throw new Exception("Custom Error: there is no {$className} class name in the given array");
        }
    }

}