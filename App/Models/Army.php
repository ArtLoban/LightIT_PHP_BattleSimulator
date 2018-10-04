<?php

namespace App\Models;


use App\Models\Interfaces\ArmyInterface;

class Army extends CompositeUnit implements ArmyInterface
{
    /**
     * Choice of battle strategy
     */
    const BATTLE_STRATEGY = [
        'random',
        'weakest',
        'strongest'
    ];

    /**
     * Contain represented army's id
     * @var
     */
    private $armyId;

    /**
     * The choice of attack strategy per army
     * @var
     */
    private $strategy;


    /**
     * @param mixed $strategy
     */
    public function setStrategy(string $strategy): void
    {
        $this->strategy = $strategy;
    }

    /**
     * @return string
     */
    public function getStrategy(): string
    {
        return $this->strategy;
    }

    /**
     * @return int
     */
    public function getArmyId(): int
    {
        return $this->armyId;
    }

    /**
     * @param int $armyId
     */
    public function setArmyId(int $armyId): void
    {
        $this->armyId = $armyId;
    }

    /**
     * @param $unit
     */
    public function addUnit($unit): void
    {
        $this->units[] = $unit;
    }

    /**
     * @return array
     */
    public function getUnits(): array
    {
        return $this->units;
    }

    /**
     * Remove Unit from units[] property
     * @param $unit
     */
    public function removeUnit($unit): void
    {
        foreach ($this->units as $key => $composedUnit) {
            if ($composedUnit === $unit) {
                unset($this->units[$key]);
            }
        }
    }

    /**
     * Determine if there any Squads composed in current army Instance
     * Return TRUE - if there is at least one Squad
     * @return bool
     */
    public function chechUnits(): bool
    {
        return ! empty($this->units);
    }

    /**
     * @return Squad
     */
    public function chooseRandomUnit(): Squad
    {
        $randomKey = array_rand($this->units);
        $randomUnit = $this->units[$randomKey];

        return $randomUnit;
    }
}
