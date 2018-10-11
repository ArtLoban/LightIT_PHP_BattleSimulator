<?php

namespace Tests\Services\ArmyConfigurator\Strategies\FromConfigCollector;

use Services\ArmyConfigurator\Strategies\FromConfigCollector;
use Tests\Services\ArmyConfigurator\Strategies\FromConfigCollectorTest;

class GetArmiesListFailureTest extends FromConfigCollectorTest
{
    /**
     * Test getArmiesList method
     *
     * @covers \Services\ArmyConfigurator\Strategies\FromConfigCollector::getArmiesList()
     * @dataProvider armiesListDataProvider
     */
    public function testGetArmiesListFailure(object $mockJsonConfigObject)
    {
        $mockConfigUploaderObject = $this->mockConfigUploader($mockJsonConfigObject);
        $fromConfigCollector = new FromConfigCollector($mockConfigUploaderObject);
        $armiesList = $fromConfigCollector->getArmiesList();

        $this->assertNull($armiesList);
    }

    /**
     * @return array
     */
    public function armiesListDataProvider(): array
    {
        return [
            [$this->mockJsonConfig($this->getTestData())]
        ];
    }

    /**
     * @return array|null
     */
    public function getTestData(): ?array
    {
        return null;
    }
}
