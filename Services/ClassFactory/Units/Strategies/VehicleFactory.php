<?php

namespace Services\ClassFactory\Units\Strategies;

use App\Models\Vehicle;
use Services\ClassFactory\Factory;
use Services\ClassFactory\Units\Contracts\UnitBuildingStrategyInterface;

class VehicleFactory implements UnitBuildingStrategyInterface
{
    /**
     * @var SoldierFactory
     */
    private $soldierFactory;

    /**
     * @var Factory
     */
    private $container;

    /**
     * VehicleFactory constructor.
     * @param Factory $container
     * @param SoldierFactory $soldierFactory
     */
    public function __construct(Factory $container, SoldierFactory $soldierFactory)
    {
        $this->container = $container;
        $this->soldierFactory = $soldierFactory;
    }

    /**
     * @return Vehicle
     */
    private function getVehicle(): Vehicle
    {
        return $this->container->create(Vehicle::class);
    }

    /**
     * Instantiate a number of Vehicle objects
     *
     * @param int $quantity
     * @return array
     */
    public function create(int $quantity = 3): array
    {
        $instances = [];
        for ($i = 0; $i < $quantity; $i++) {
            $vehicle = $this->getVehicle();
            $vehicle->addUnit($this->createSoldiers());
            $instances[] = $vehicle;
        }

        return $instances;
    }

    /**
     * @return array
     */
    public function createSoldiers(): array
    {
        $factory = $this->soldierFactory;
        $soldiers = $factory->create(Vehicle::VEHICLE_OPERATORS);

        return $soldiers;
    }
}
