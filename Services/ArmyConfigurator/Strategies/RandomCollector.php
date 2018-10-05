<?php

namespace Services\ArmyConfigurator\Strategies;

use App\Models\Army;
use Services\ArmyConfigurator\Contracts\ConfiguratorInterface;

class RandomCollector implements ConfiguratorInterface
{
    /**
     * TRUE - if needed armies with equal strength
     * FALSE - if each army should have a random set of squads and units into them
     */
    const EQUAL_TERMS = true;

    /**
     * @var array
     */
    private $strategyType = Army::BATTLE_STRATEGY;

    /**
     * @var array
     */
    private $unitType = [
        'soldiers',
        'vehicles',
    ];

    /**
     * @var array
     */
    private $armySettings = [
        'NumberOfArmies' => [
            'min' => 2,
            'max' => 7
        ],
        'SquadsPerArmy' => [
            'min' => 2,
            'max' => 5
        ],
        'UnitsPerSquad' => [
            'min' => 5,
            'max' => 10
        ]
    ];

    /**
     * @return array
     */
    public function getArmiesList(): array
    {
        $list = (self::EQUAL_TERMS) ? $this->makeEqualArmies() : $this->makeRandomArmies();

        return $list;
    }

    /**
     * Compose an array with a number of armies with random units strength
     * @return array
     */
    private function makeRandomArmies(): array
    {
        $list = [];
        for ($i = 0; $i < $this->setArmiesQuantity(); $i++) {
            $list[$i] = [
                'strategy' => $this->setStrategy(),
                'squads' => $this->prepareSquadArray(),
            ];
        }

        return $list;
    }

    /**
     * Compose an array with a number of armies with equal units
     * @return array
     */
    private function makeEqualArmies(): array
    {
        $armyUnit = [
            'strategy' => '',
            'squads' => $this->prepareSquadArray(),
        ];

        $list = [];
        for ($i = 0; $i < $this->setArmiesQuantity(); $i++) {
            $armyUnit['strategy'] = $this->setStrategy();
            $list[] = $armyUnit;
        }

        return $list;
    }

    /**
     * Compose an array with a number of random unit types with random quantity of each
     * @return array
     */
    private function prepareSquadArray(): array
    {
        $squads = [];
        for ($i = 0; $i < $this->setSquadsQuantity(); $i++) {
            $squads[] = [$this->setUnitType() => $this->setUnitsQuantity()];
        }

        return $squads;
    }

    /**
     * Generate a random number from given sqope
     * @return int
     */
    private function setArmiesQuantity(): int
    {
        $result = mt_rand($this->armySettings['NumberOfArmies']['min'], $this->armySettings['NumberOfArmies']['max']);

        return $result;
    }

    /**
     * Generate a random number from given sqope
     * @return int
     */
    private function setSquadsQuantity(): int
    {
        $result = mt_rand($this->armySettings['SquadsPerArmy']['min'], $this->armySettings['SquadsPerArmy']['max']);

        return $result;
    }

    /**
     * Generate a random number from given sqope
     * @return int
     */
    private function setUnitsQuantity(): int
    {
        $result = mt_rand($this->armySettings['UnitsPerSquad']['min'], $this->armySettings['UnitsPerSquad']['max']);

        return $result;
    }

    /**
     * Return a random string from $strategyType array property
     * @return string
     */
    private function setStrategy(): string
    {
        $randomKey = array_rand($this->strategyType);
        $result = $this->strategyType[$randomKey];

        return $result;
    }

    /**
     * Return a random string from $unitType array property
     * @return string
     */
    private function setUnitType(): string
    {
        $randomKey = array_rand($this->unitType);
        $result = $this->unitType[$randomKey];

        return $result;
    }
}
