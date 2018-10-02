<?php

namespace Services\ArmyGenerator;

use Services\ClassFactory\Units\ArmyFactory;

class GenerateArmy
{
    /**
     * @var ArmyFactory
     */
    private $armyFactory;

    /**
     * GenerateArmy constructor.
     * @param ArmyFactory $armyFactory
     */
    public function __construct(ArmyFactory $armyFactory)
    {
        $this->armyFactory = $armyFactory;
    }

    /**
     * Transform an initial array with list of required armies into
     *  an array of Army Models composed with squads and units according to the list
     *
     * @param array $armiesList
     * @return array
     */
    public function generate(array $armiesList): array
    {
        $armies = [];
        $armyId = 1;
        foreach ($armiesList as $list) {
            $armies[] = $this->armyFactory->create($list, $armyId);
            $armyId++;
        }

        return $armies;
    }

}