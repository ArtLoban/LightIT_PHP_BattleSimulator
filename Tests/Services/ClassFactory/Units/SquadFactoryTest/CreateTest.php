<?php

namespace Tests\Services\ClassFactory\Units\SquadFactoryTest;

use App\Models\Squad;
use PHPUnit\Framework\TestCase;
use Services\ClassFactory\Factory;
use Services\ClassFactory\Units\SquadFactory;
use Services\ClassFactory\Units\UnitBuildingStrategy;

class CreateTest extends TestCase
{
    /**
     * Test create method
     *
     * @covers \Services\ClassFactory\Units\SquadFactory::create()
     * @dataProvider createDataProvider
     */
    public function testCreate(string $className, string $squadType)
    {
        $mockSquad = $this->mockSquad();
        $mockFactory = $this->mockFactory($mockSquad);
        $mockUnitBuildingStrategy = $this->mockUnitBuildingStrategy();
        $squadFactory = new SquadFactory($mockFactory, $mockUnitBuildingStrategy);

        $squad = $squadFactory->create($squadType);

        $this->assertInstanceOf($className, $squad);
    }

    /**
     * @return array
     */
    public function createDataProvider(): array
    {
        return [
            [Squad::class, 'vehicles'],
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
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockSquad(): object
    {
        return $this->createMock(Squad::class);
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockUnitBuildingStrategy(): object
    {
        return $this->createMock(UnitBuildingStrategy::class);
    }
}
