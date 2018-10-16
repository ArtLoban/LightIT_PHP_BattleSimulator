<?php

namespace Tests\Services\ClassFactory\Units\UnitBuildingStrategyTest;

use PHPUnit\Framework\TestCase;
use Services\ClassFactory\Factory;
use Services\ClassFactory\Units\Strategies\SoldierFactory;
use Services\ClassFactory\Units\Strategies\VehicleFactory;
use Services\ClassFactory\Units\UnitBuildingStrategy;

class CreateSuccessTest extends TestCase
{
    /**
     * Test create method
     *
     * @covers \Services\ClassFactory\Units\UnitBuildingStrategy::create()
     * @dataProvider createDataProvider
     */
    public function testCreateSuccess(string $alias, string $strategyClass)
    {
        $mockStrategyFactory = $this->mockStrategyFactory($strategyClass);
        $mockFactory = $this->mockFactory($mockStrategyFactory);
        $unitBuildingStrategy = new UnitBuildingStrategy($mockFactory);

        $unitStrategy = $unitBuildingStrategy->create($alias);

        $this->assertInstanceOf($strategyClass, $unitStrategy);
    }

    /**
     * @return array
     */
    public function createDataProvider(): array
    {
        return [
            ['soldiers', SoldierFactory::class],
            ['vehicles', VehicleFactory::class],
        ];
    }

    /**
     * @param $strategyClass
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockFactory($strategyClass): object
    {
        $factory = $this->getMockBuilder(Factory::class)
            ->disableOriginalConstructor()
            ->getMock();
        $factory->method('create')->willReturn($strategyClass);

        return $factory;
    }

    /**
     * @param string $strategyFactoryName
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockStrategyFactory(string $strategyFactoryName): object
    {
        return $this->createMock($strategyFactoryName);
    }
}
