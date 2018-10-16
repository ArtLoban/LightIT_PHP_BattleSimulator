<?php

namespace Tests\Services\ClassFactory\Units\ArmyFactoryTest;

use App\Models\Army;
use App\Models\Squad;
use PHPUnit\Framework\TestCase;
use Services\ClassFactory\Units\ArmyFactory;
use Services\ClassFactory\Units\SquadFactory;

class CreateSuccessTest extends TestCase
{
    /**
     * Test create method
     *
     * @covers \Services\ClassFactory\Units\ArmyFactory::create()
     * @dataProvider createDataProvider
     */
    public function testCreateSuccess(string $className, array $armiesList)
    {
        $mockSquad = $this->mockSquad();
        $mockSquadFactory = $this->mockSquadFactory($mockSquad);
        $armyFactory = new ArmyFactory($mockSquadFactory);

        $army = $armyFactory->create($armiesList);

        $this->assertInstanceOf($className, $army);
    }

    /**
     * @return array
     */
    public function createDataProvider(): array
    {
        return [
            [Army::class, $this->getTestData()],
        ];
    }

    /**
     * @param object $squad
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockSquadFactory(object $squad): object
    {
        $squadFactory = $this->getMockBuilder(SquadFactory::class)
            ->disableOriginalConstructor()
            ->getMock();
        $squadFactory->method('create')->willReturn($squad);

        return $squadFactory;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockSquad(): object
    {
        return $this->createMock(Squad::class);
    }

    /**
     * @return array
     */
    public function getTestData(): array
    {
        return [
            'strategy' => 'random',
            'squads' => [
                0 => ['soldiers' => 7],
                1 => ['vehicles' => 5],
            ]
        ];
    }
}
