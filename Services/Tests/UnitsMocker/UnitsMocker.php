<?php

namespace Services\Tests\UnitsMocker;

class UnitsMocker implements UnitsMockerInterface
{
    /**
     * Provide an array of Mock units
     *
     * @param object $thisObject
     * @param string $className
     * @param string $methodName
     * @param int $unitsQuantity
     * @param mixed $returningValue
     * @return array
     */
    public function mock(
        object $thisObject,
        string $className,
        string $methodName,
        int $unitsQuantity,
        $returningValue
    ): array
    {
        $units = [];
        for ($i = 0; $i < $unitsQuantity; $i++) {
            $soldier = $thisObject->getMockBuilder($className)
                ->disableOriginalConstructor()
                ->getMock();
            $soldier->method($methodName)->willReturn($returningValue);
            $units[] = $soldier;
        }

        return $units;
    }
}
