<?php

namespace Tests\Services\ArmyGenerator;

use App\Models\Army;
use PHPUnit\Framework\TestCase;
use Services\ArmyGenerator\GenerateArmy;
use Services\ClassFactory\Units\ArmyFactory;

class GenerateArmyTest extends TestCase
{
    /**
     * Test generate method
     *
     * @covers \Services\ArmyGenerator\GenerateArmy::generate()
     * @dataProvider generateDataProvider
     */
    public function testGenerate(Army $armyUnit, array $armiesList)
    {
        $armyFactory = $this->mockArmyFactory($armyUnit);
        $generateArmy = new GenerateArmy($armyFactory);

        $armies = $generateArmy->generate($armiesList);
        $this->assertInternalType('array', $armies);
        $this->assertContainsOnlyInstancesOf(Army::class, $armies);
    }

    /**
     * @return array
     */
    public function generateDataProvider(): array
    {
        return [
            [$this->getArmyMock(), []]
        ];
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function getArmyMock(): object
    {
        return $this->createMock(Army::class);
    }

    /**
     * @param Army $armyUnit
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockArmyFactory(Army $armyUnit)
    {
        $armyFactory = $this->getMockBuilder(ArmyFactory::class)
            ->disableOriginalConstructor()
            ->getMock();
        $armyFactory->method('create')->willReturn($armyUnit);

        return $armyFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        $this->generateArmy = null;
        gc_collect_cycles();
    }
}
