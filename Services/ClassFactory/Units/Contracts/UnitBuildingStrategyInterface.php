<?php

namespace Services\ClassFactory\Units\Contracts;

interface UnitBuildingStrategyInterface
{
    /**
     * @param int $quantity
     * @return array
     */
    public function create(int $quantity): array;

}