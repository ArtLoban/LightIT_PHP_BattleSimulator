<?php

namespace Tests\Services\ClassFactory\Units\ArmyFactoryTest;

use PHPUnit\Framework\TestCase;
use Services\ClassFactory\Units\ArmyFactory;
use Services\ClassFactory\Units\SquadFactory;

class CreateExceptionTest extends TestCase
{
    /**
     * Test create method throws exception
     *
     * @covers \Services\ClassFactory\Units\ArmyFactory::create()
     * @dataProvider createDataProvider
     */
    public function testCreateException(array $armiesList)
    {
        $this->expectException(\Exception::class);

        $mockSquadFactory = $this->mockSquadFactory();
        $armyFactory = new ArmyFactory($mockSquadFactory);
        $armyFactory->create($armiesList);
    }

    /**
     * @return array
     */
    public function createDataProvider(): array
    {
        return [
            [array('test_no_required_field')],
        ];
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockSquadFactory(): object
    {
        return $this->createMock(SquadFactory::class);
    }
}
