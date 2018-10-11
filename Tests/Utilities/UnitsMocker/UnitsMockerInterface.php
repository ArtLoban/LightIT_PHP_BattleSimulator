<?php

namespace Tests\Utilities\UnitsMocker;

use PHPUnit\Framework\TestCase;

interface UnitsMockerInterface
{
    /**
     * Provide an array of Mock units
     *
     * @param TestCase $test
     * @param string $className
     * @param string $methodName
     * @param int $unitsQuantity
     * @param mixed $returningValue
     * @return array
     */
    public function mock(
        TestCase $test,
        string $className,
        string $methodName,
        int $unitsQuantity,
        $returningValue
    ): array;
}
