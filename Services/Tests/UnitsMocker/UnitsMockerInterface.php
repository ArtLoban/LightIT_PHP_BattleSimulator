<?php

namespace Services\Tests\UnitsMocker;

interface UnitsMockerInterface
{
    /**
     * Provide an array of Mock units
     *
     * @param object $thisObject
     * @param string $className
     * @param string $methodName
     * @param int $unitsQuantity
     * @param $returningValue
     * @return array
     */
    public function mock(
        object $thisObject,
        string $className,
        string $methodName,
        int $unitsQuantity,
        $returningValue
    ): array;
}
