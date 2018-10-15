<?php

namespace Tests\Services\ConfigUploader\Strategies\JsonConfigTest;

use Tests\Services\ConfigUploader\Strategies\JsonConfigTest;

class GetConfigSuccessTest extends JsonConfigTest
{
    /**
     * Test getConfig method is successful
     *
     * @covers \Services\ConfigUploader\Strategies\JsonConfig::getConfig()
     * @dataProvider getConfigDataProvider
     */
    public function testGetConfigSuccess(string $fileName, string $strategyKey, string $squadsKey, int $arrayKey)
    {
        $config = $this->jsonConfig->getConfig($fileName);

        $this->assertInternalType('array', $config);
        $this->assertNotEmpty($config);
        $this->assertArrayHasKey($strategyKey, $config[$arrayKey]);
        $this->assertArrayHasKey($squadsKey, $config[$arrayKey]);
    }

    /**
     * @return array
     */
    public function getConfigDataProvider(): array
    {
        return [
            ['Tests/storage/configs/test_battle_config', 'strategy', 'squads', 0],
        ];
    }
}
