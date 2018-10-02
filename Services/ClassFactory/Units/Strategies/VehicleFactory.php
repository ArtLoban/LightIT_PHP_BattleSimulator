<?php

namespace Services\ClassFactory\Units\Strategies;

use App\Models\Vehicle;
use Services\ClassFactory\Units\Contracts\UnitBuildingStrategyInterface;

class VehicleFactory implements UnitBuildingStrategyInterface
{
    /**
     * @var SoldierFactory
     */
    private $soldierFactory;

    /**
     * VehicleFactory constructor.
     * @param SoldierFactory $soldierFactory
     */
    public function __construct(SoldierFactory $soldierFactory)
    {
        $this->soldierFactory = $soldierFactory;
    }

    /**
     * @return Vehicle
     */
    private function getVehicle(): Vehicle
    {
        return new Vehicle();
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