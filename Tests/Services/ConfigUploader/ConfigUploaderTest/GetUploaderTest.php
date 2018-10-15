<?php

namespace Tests\Services\ConfigUploader\ConfigUploaderTest;

use PHPUnit\Framework\TestCase;
use Services\ConfigUploader\ConfigFactory;
use Services\ConfigUploader\ConfigUploader;
use Services\ConfigUploader\Strategies\JsonConfig;

class GetUploaderTest extends TestCase
{
    /**
     * Test getUploader method
     *
     * @covers \Services\ConfigUploader\ConfigUploader::getUploader()
     * @dataProvider getUploaderDataProvider
     */
    public function testGetUploader(string $aliasName)
    {
        $mockConfigUploader = $this->mockConfigUploader();
        $configUploader = new ConfigUploader($mockConfigUploader);
        $uploader = $configUploader->getUploader($aliasName);

        $this->assertInstanceOf(JsonConfig::class, $uploader);
    }

    /**
     * @return array
     */
    public function getUploaderDataProvider(): array
    {
        return [
            ['JsonConfig'],
        ];
    }

    /**
     * @param string $uploaderName
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockConfigUploader(): object
    {
        $mockJsonConfig = $this->mockJsonConfig();
        $mockConfigUploader = $this->getMockBuilder(ConfigFactory::class)
            ->disableOriginalConstructor()
            ->getMock();
        $mockConfigUploader->method('get')->willReturn($mockJsonConfig);

        return $mockConfigUploader;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockJsonConfig(): object
    {
        return $this->createMock(JsonConfig::class);
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown(): void
    {
        gc_collect_cycles();
    }
}
