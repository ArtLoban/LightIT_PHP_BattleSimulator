<?php

namespace Tests\Services\ArmyConfigurator\Strategies\FromConfigCollector;

use Services\ArmyConfigurator\Strategies\FromConfigCollector;
use Tests\Services\ArmyConfigurator\Strategies\FromConfigCollectorTest;

class GetArmiesListSuccessTest extends FromConfigCollectorTest
{
    /**
     * Test getArmiesList method
     *
     * @covers \Services\ArmyConfigurator\Strategies\FromConfigCollector::getArmiesList()
     * @dataProvider armiesListDataProvider
     */
    public function testGetArmiesListSuccess(object $mockJsonConfigObject, int $itemQuantity )
    {
        $mockConfigUploaderObject = $this->mockConfigUploader($mockJsonConfigObject);
        $fromConfigCollector = new FromConfigCollector($mockConfigUploaderObject);
        $armiesList = $fromConfigCollector->getArmiesList();

        $this->assertInternalType('array', $armiesList);
        $this->assertCount($itemQuantity, $armiesList);
    }

    /**
     * @return array
     */
    public function armiesListDataProvider(): array
    {
        return [
            [$this->mockJsonConfig($this->getTestData()), 3]
        ];
    }

    /**
     * @return array|null
     */
    public function getTestData(): ?array
    {
        return [
            ['test_army_1'],
            ['test_army_2'],
            ['test_army_3'],
        ];
    }
}
