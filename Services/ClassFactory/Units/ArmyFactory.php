<?php

namespace Services\ClassFactory\Units;

use App\Models\Army;
use App\Models\Squad;

class ArmyFactory
{
    /**
     * @var Army
     */
    private $armyUnit;

    /**
     * ArmyFactory constructor.
     */
    public function __construct()
    {
        $unitFactory = new UnitFactory;
        $this->armyUnit = $unitFactory->create('Army');
    }

    /**
     * @param array $list
     * @param int $id
     * @return Army
     */
    public function create(array $list, int $id): Army
    {
        $this->armyUnit->setArmyId($id);
        $this->armyUnit->setStrategy($list['strategy']);

        foreach ($list['squads'] as $squadItem) {
            $this->armyUnit->addUnit($this->createSquad($squadItem));
        }
        return $this->armyUnit;
    }

    /**
     * @param array $squadItem
     * @return Squad
     */
    public function createSquad(array $squadItem): Squad
    {
        $squad =  new SquadFactory();

        foreach ($squadItem as $key => $value) {
            $squad = $squad->create($key, $value);
        }
        return $squad;
    }

}