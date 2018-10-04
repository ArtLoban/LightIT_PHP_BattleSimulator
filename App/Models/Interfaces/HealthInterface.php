<?php

namespace App\Models\Interfaces;


interface HealthInterface
{
    /**
     * @return float
     */
    public function getHealth(): float;

    /**
     * @param int $health
     */
    public function setHealth(int $health): void;
}
