<?php

namespace Services\ClassFactory\Units;

use App\Models\Army;
use App\Models\Soldier;
use App\Models\Squad;
use App\Models\Vehicle;

class UnitFactory
{
    /**
     * @var array
     */
    private $classes = [
        'Army' => Army::class,
        'Squad' => Squad::class,
        'Vehicle' => Vehicle::class,
        'Soldier' => Soldier::class,
    ];

    /**
     * @param string $className
     * @return object
     */
    public function create(string $className): object
    {
        /*if (!array_key_exists($className, $this->classes)) {
            throw new Exception("Custom Error: there is no $className class name in the given array");
        }*/

        $classInstance = new $this->classes[$className];

        return $classInstance;
    }
}