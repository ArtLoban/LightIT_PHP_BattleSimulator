<?php

namespace Tests\Services\ClassFactory\Units\Strategies\SoldierFactoryTest;

use App\Models\Soldier;
use PHPUnit\Framework\TestCase;
use Services\ClassFactory\Factory;
use Services\ClassFactory\Units\Strategies\SoldierFactory;

class CreateTest extends TestCase
{
    /**
     * Test create method
     *
     * @covers \Services\ClassFactory\Units\Strategies\SoldierFactory::create()
     * @dataProvider createDataProvider
     */
    public function testCreate(string $className)
    {
        $mockSoldier = $this->mockSoldier();
        $mockFactory = $this->mockFactory($mockSoldier);
        $soldierFactory = new SoldierFactory($mockFactory);

        $soldiers = $soldierFactory->create();

        $this->assertInternalType('array', $soldiers);
        $this->assertNotEmpty($soldiers);
        $this->assertContainsOnlyInstancesOf($className, $soldiers);
    }

    /**
     * @return array
     */
    public function createDataProvider(): array
    {
        return [
            [Soldier::class],
        ];
    }

    /**
     * @param $strategyClass
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockFactory(object $soldier): object
    {
        $factory = $this->getMockBuilder(Factory::class)
            ->disableOriginalConstructor()
            ->getMock();
        $factory->method('create')->willReturn($soldier);

        return $factory;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockSoldier(): object
    {
        return $this->createMock(Soldier::class);
    }
}
