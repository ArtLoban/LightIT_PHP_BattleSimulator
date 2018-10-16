<?php

namespace Tests\Services\ClassFactory\Units\Strategies\VehicleFactoryTest;

use App\Models\Vehicle;
use PHPUnit\Framework\TestCase;
use Services\ClassFactory\Factory;
use Services\ClassFactory\Units\Strategies\SoldierFactory;
use Services\ClassFactory\Units\Strategies\VehicleFactory;

class CreateTest extends TestCase
{
    /**
     * Test create method
     *
     * @covers \Services\ClassFactory\Units\Strategies\VehicleFactory::create
     * @dataProvider createDataProvider
     */
    public function testCreate(string $className)
    {
        $mockVehicle = $this->mockVehicle();
        $mockFactory = $this->mockFactory($mockVehicle);
        $mockSoldierFactory = $this->mockSoldierFactory();;
        $vehicleFactory = new VehicleFactory($mockFactory, $mockSoldierFactory);

        $vehicles = $vehicleFactory->create();

        $this->assertInternalType('array', $vehicles);
        $this->assertNotEmpty($vehicles);
        $this->assertContainsOnlyInstancesOf($className, $vehicles);
    }

    /**
     * @return array
     */
    public function createDataProvider(): array
    {
        return [
            [Vehicle::class],
        ];
    }

    /**
     * @param $strategyClass
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockFactory(object $vehicle): object
    {
        $factory = $this->getMockBuilder(Factory::class)
            ->disableOriginalConstructor()
            ->getMock();
        $factory->method('create')->willReturn($vehicle);

        return $factory;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockVehicle(): object
    {
        return $this->createMock(Vehicle::class);
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockSoldierFactory(): object
    {
        return $this->createMock(SoldierFactory::class);
    }
}
