<?php

namespace Tests\Services\ConfigUploader\ConfigFactoryTest;

use PHPUnit\Framework\TestCase;
use Services\ClassFactory\Factory;
use Services\ConfigUploader\ConfigFactory;
use Services\ConfigUploader\Strategies\JsonConfig;

class GetTest extends TestCase
{
    /**
     * Test get method
     *
     * @covers \Services\ConfigUploader\ConfigFactory::get()
     * @dataProvider getDataProvider
     */
    public function testGet(string $strategy)
    {
        $mockFactory = $this->mockFactory();
        $configFactory = new ConfigFactory($mockFactory);
        $jsonConfigUploader = $configFactory->get($strategy);

        $this->assertInstanceOf(JsonConfig::class, $jsonConfigUploader);
    }

    /**
     * @return array
     */
    public function getDataProvider(): array
    {
        return [
            ['JsonConfig'],
        ];
    }

    /**
     * @param string $uploaderName
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    public function mockFactory(): object
    {
        $mockJsonConfig = $this->mockJsonConfig();
        $mockFactory = $this->getMockBuilder(Factory::class)
            ->disableOriginalConstructor()
            ->getMock();
        $mockFactory->method('create')->willReturn($mockJsonConfig);

        return $mockFactory;
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
