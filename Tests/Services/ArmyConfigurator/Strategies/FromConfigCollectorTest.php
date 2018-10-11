<?php

namespace Tests\Services\ArmyConfigurator\Strategies;

use PHPUnit\Framework\TestCase;
use Services\ConfigUploader\ConfigUploader;
use Services\ConfigUploader\Strategies\JsonConfig;

abstract class FromConfigCollectorTest extends TestCase
{
    /**
     * @param object $mockObject
     * @return object
     */
    public function mockConfigUploader(object $mockObject): object
    {
        $mockConfigUploader = $this->getMockBuilder(ConfigUploader::class)
            ->disableOriginalConstructor()
            ->getMock();
        $mockConfigUploader->method('getUploader')->willReturn($mockObject);

        return $mockConfigUploader;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockJsonConfig(?array $testData): object
    {
        $mockJsonConfig = $this->getMockBuilder(JsonConfig::class)
            ->disableOriginalConstructor()
            ->getMock();
        $mockJsonConfig->method('getConfig')->willReturn($testData);

        return $mockJsonConfig;
    }

    /**
     * @return array|null
     */
    abstract public function getTestData(): ?array;

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        $this->fromConfigCollector = null;
        gc_collect_cycles();
    }
}
