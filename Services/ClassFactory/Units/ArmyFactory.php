<?php

namespace Services\ClassFactory\Units;

use App\Models\Army;
use App\Models\Squad;
use Exception;
use Throwable;

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

        try {
            $army->setStrategy($list['strategy']);
        } catch (Throwable $exception) {
            throw new Exception("Custom Error: there is no field \"{$list['strategy']}\" in the given array");
        }

        $squadId = 1;
        foreach ($list['squads'] as $squadItem) {
            $squad = $this->createSquad($squadItem, $armyId, $squadId);
            $army->addUnit($squad);
            $squadId++;
        }

        return $army;
    }

    /**
     * @param array $squadItem
     * @param int $armyId
     * @param int $squadId
     * @return Squad
     */
    public function createSquad(array $squadItem, int $armyId = 1, int $squadId = 1): Squad
    {
        foreach ($squadItem as $squadType => $quantity) {
            $squad = $this->squadFactory->create($squadType, $quantity, $armyId, $squadId);
        }

        return $squad;
    }

}