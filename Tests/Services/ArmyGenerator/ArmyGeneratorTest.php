<?php

namespace Tests\Services\ArmyGenerator;

use App\Models\Army;
use PHPUnit\Framework\TestCase;
use Services\ArmyGenerator\ArmyGenerator;
use Services\ClassFactory\Units\ArmyFactory;

class ArmyGeneratorTest extends TestCase
{
    /**
     * Test generate method
     *
     * @covers \Services\ArmyGenerator\ArmyGenerator::generate()
     * @dataProvider generateDataProvider
     */
    public function testGenerate(Army $armyUnit, array $armiesList, int $result)
    {
        $armyFactory = $this->mockArmyFactory($armyUnit);
        $armyGenerator = new ArmyGenerator($armyFactory);
        $armies = $armyGenerator->generate($armiesList);

        $this->assertInternalType('array', $armies);
        $this->assertCount($result, $armies);
        $this->assertContainsOnlyInstancesOf(Army::class, $armies);
    }

    /**
     * @return array
     */
    public function generateDataProvider(): array
    {
        return [
            [$this->getArmyMock(), [['army_1'], ['army_2']], 2],
            [$this->getArmyMock(), [['army_1'], ['army_2'], ['army_3']], 3],
            [$this->getArmyMock(), [], 0]
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
