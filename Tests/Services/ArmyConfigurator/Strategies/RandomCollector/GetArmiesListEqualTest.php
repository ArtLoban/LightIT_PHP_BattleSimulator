<?php

namespace Tests\Services\ArmyConfigurator\Strategies\RandomCollector;

use Tests\Services\ArmyConfigurator\Strategies\RandomCollectorTest;

class GetArmiesListEqualTest extends RandomCollectorTest
{
    /**
     * Test getArmiesList method
     *
     * @covers \Services\ArmyConfigurator\Strategies\RandomCollector::getArmiesList()
     * @dataProvider armiesListDataProvider
     */
    public function testGetArmiesListEqual(string $armyUnitKey1, string $armyUnitKey2, int $arrayKey)
    {
        $list = $this->randomCollector->getArmiesList();

        $this->assertNotEmpty($list);
        $this->assertInternalType('array', $list);
        $this->assertArrayHasKey($armyUnitKey1, $list[$arrayKey]);
        $this->assertArrayHasKey($armyUnitKey2, $list[$arrayKey]);
    }

    /**
     * @return array
     */
    public function armiesListDataProvider(): array
    {
        return [
            ['strategy', 'squads', 0],
            ['strategy', 'squads', 1],
        ];
    }
}
