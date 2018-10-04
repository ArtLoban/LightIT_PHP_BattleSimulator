<?php

namespace App\Models\Interfaces;

interface ArmyInterface
{
    /**
     * @return int
     */
    public function getArmyId(): int;

    /**
     * @param int $id
     */
    public function setArmyId(int $id): void;
}
