<?php

namespace Services\ClassFactory\Units;

use App\Models\Army;

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
        $this->armyUnit = new Army();
    }

    /**
     * @param array $list
     * @param int $id
     * @return Army
     */
    public function create(array $list, int $id)
    {
        $this->armyUnit->setArmyId($id);
        $this->armyUnit->setStrategy($list['strategy']);

        foreach ($list['squads'] as $squadItem) {
            $this->armyUnit->addUnit($this->createSquad($squadItem));
        }
        return $this->armyUnit;
    }

    /**
     * @param $squadItem
     * @return mixed|SquadFactory
     */
    public function createSquad($squadItem)
    {
        $squad =  new SquadFactory();

        foreach ($squadItem as $key => $value) {
            $squad = $squad->create($key, $value);
        }

        return $squad;
    }

}