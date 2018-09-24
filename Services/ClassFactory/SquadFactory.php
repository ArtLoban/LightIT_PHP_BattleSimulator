<?php

namespace Services\ClassFactory;

use App\Models\Squad;

class SquadFactory
{
    private $squad;

    private $squadTypes = [
        'soldiers' => SoldierFactory::class,
        'vehicles' => VehicleFactory::class,
    ];

    /**
     * SquadFactory constructor.
     */
    public function __construct()
    {
        $this->squad = new Squad();
    }

    public function create($squadType, $quantity)
    {
        foreach ($this->squadTypes as $unitName => $unitFactory) {
            if ($unitName === $squadType) {
                $unit = new $unitFactory;
            }
        }

        $units = $unit->create($quantity);
        return $units;
    }
}