<?php

namespace Services\ClassFactory\Units;

use App\Models\Vehicle;

class VehicleFactory
{
    /**
     * Instantiate a number of Vehicle objects
     *
     * @param int $quantity
     * @return array
     */
    public function create(int $quantity): array
    {
        $instances = [];
        for ($i = 0; $i < $quantity; $i++) {
            $vehicle = new Vehicle();
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
        $factory = new SoldierFactory;
        $soldiers = $factory->create(Vehicle::VEHICLE_OPERATORS);

        return $soldiers;
    }
}