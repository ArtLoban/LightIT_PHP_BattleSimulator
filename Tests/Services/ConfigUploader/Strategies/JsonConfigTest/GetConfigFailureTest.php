<?php

namespace Tests\Services\ConfigUploader\Strategies\JsonConfigTest;

use Tests\Services\ConfigUploader\Strategies\JsonConfigTest;

class GetConfigFailureTest extends JsonConfigTest
{
    /**
     * Test getConfig method fails
     *
     * @covers \Services\ConfigUploader\Strategies\JsonConfig::getConfig()
     * @dataProvider getConfigDataProvider
     */
    public function testGetConfigFailure(string $fileName)
    {
        $config = $this->jsonConfig->getConfig($fileName);

        $this->assertNull($config);
    }

    /**
     * @return array
     */
    public function getConfigDataProvider(): array
    {
        return [
            ['Tests/storage/configs/test_battle_config_empty'],
        ];
    }
}
