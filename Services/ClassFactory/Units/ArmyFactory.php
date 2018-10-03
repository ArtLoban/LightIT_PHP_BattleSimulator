<?php

namespace Services\ClassFactory\Units;

use App\Models\Army;
use App\Models\Squad;

class ArmyFactory
{
    /**
     * @var SquadFactory
     */
    private $squadFactory;

    /**
     * ArmyFactory constructor.
     * @param SquadFactory $squadFactory
     */
    public function __construct(SquadFactory $squadFactory)
    {
        $this->squadFactory = $squadFactory;
    }

    /**
     * @return Army
     */
    private function getArmy(): Army
    {
        return new Army();
    }

    /**
     * @param array $list
     * @param int $id
     * @return Army
     */
    public function create(array $list, int $armyId = 1): Army
    {
        $army = $this->getArmy();
        $army->setArmyId($armyId);
        $army->setStrategy($list['strategy']);

        $squadId = 1;
        foreach ($list['squads'] as $key => $squadItem) {
            $squad = $this->createSquad($squadItem, $armyId, $squadId);
            $army->addUnit($squad);
            $squadId++;
        }

        return $army;
    }

    /**
     * @param array $squadItem
     * @param SquadFactory $squadFactory
     * @return Squad
     */
    public function createSquad(array $squadItem, int $armyId = 1, int $squadId = 1): Squad
    {
        foreach ($squadItem as $key => $value) {
            $squad = $this->squadFactory->create($key, $value, $armyId, $squadId);
        }

        return $squad;
    }

}