<?php

namespace Tests\Services\ClassFactory\Units\UnitBuildingStrategyTest;

use Exception;
use PHPUnit\Framework\TestCase;
use Services\ClassFactory\Factory;
use Services\ClassFactory\Units\UnitBuildingStrategy;

class CreateExceptionTest extends TestCase
{
    /**
     * Test create method throws exception
     *
     * @covers \Services\ClassFactory\Units\UnitBuildingStrategy::create()
     * @dataProvider createDataProvider
     */
    public function testCreateSuccess(string $alias)
    {
        $mockFactory = $this->mockFactory();
        $unitBuildingStrategy = new UnitBuildingStrategy($mockFactory);

        $this->expectException(Exception::class);

        $unitBuildingStrategy->create($alias);
    }

    /**
     * @return array
     */
    public function createDataProvider(): array
    {
        return [
            ['test_wrong_alias_name'],
        ];
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockFactory(): object
    {
        return $this->createMock(Factory::class);
    }
}
