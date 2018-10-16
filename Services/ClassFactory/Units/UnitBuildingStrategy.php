<?php

namespace Services\ClassFactory\Units;

use Services\ClassFactory\Factory;
use Services\ClassFactory\Units\Contracts\UnitBuildingStrategyInterface;
use Services\ClassFactory\Units\Strategies\SoldierFactory;
use Services\ClassFactory\Units\Strategies\VehicleFactory;
use Exception;
use Throwable;

class UnitBuildingStrategy
{
    /**
     * @var Factory
     */
    private $container;

    /**
     * @var array
     */
    private $classes = [
        'soldiers' => SoldierFactory::class,
        'vehicles' => VehicleFactory::class,
    ];

    /**
     * UnitBuildingStrategy constructor.
     * @param Factory $container
     */
    public function __construct(Factory $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $className
     * @return object
     */
    public function create(string $className): UnitBuildingStrategyInterface
    {
        try {
            return $this->container->create($this->classes[$className]);
        } catch (Throwable $exception) {
            throw new Exception("Custom Error: there is no \"{$className}\" class name in the given array");
        }
    }
}
