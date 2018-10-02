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
    public function create(array $list, int $id): Army
    {
        $army = $this->getArmy();
        $army->setArmyId($id);
        $army->setStrategy($list['strategy']);

        foreach ($list['squads'] as $key => $squadItem) {
            $squad = $this->createSquad($squadItem);
            $army->addUnit($squad);
        }

        return $army;
    }

    /**
     * @param array $squadItem
     * @param SquadFactory $squadFactory
     * @return Squad
     */
    public function createSquad(array $squadItem): Squad
    {
        foreach ($squadItem as $key => $value) {
            $squad = $this->squadFactory->create($key, $value);
        }

        return $squad;
    }

}