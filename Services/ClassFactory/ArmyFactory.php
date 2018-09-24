<?php

namespace Services\ClassFactory;

use App\Models\Army;

class ArmyFactory
{
    private $armyUnit;
    /**
     * ArmyFactory constructor.
     */
    public function __construct()
    {
        $this->armyUnit = new Army();
    }

    public function create(array $list, int $id)
    {
        $this->armyUnit->setArmyId($id);
        $this->armyUnit->setStrategy($list['strategy']);

        foreach ($list['squads'] as $squadItem) {
            $this->armyUnit->addUnit($this->createSquad($squadItem));
        }

        return $this->armyUnit;
    }

    public function createSquad($squadItem)
    {
        $squad =  new SquadFactory();

        foreach ($squadItem as $key => $value) {
            $squad = $squad->create($key, $value);
        }

        return $squad;
    }

}