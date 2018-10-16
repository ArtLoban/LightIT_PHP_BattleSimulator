<?php

namespace Tests\Services\ClassFactory\FactoryTest;

use Exception;
use Tests\Services\ClassFactory\FactoryTest;

class CreateExceptionTest extends FactoryTest
{
    /**
     * Test create method throws exception
     *
     * @covers \Services\ClassFactory\Factory::create()
     * @dataProvider createDataProvider
     */
    public function testCreateException(string $className)
    {
        $this->expectException(Exception::class);
        $this->factory->create($className);
    }

    /**
     * @return array
     */
    public function createDataProvider(): array
    {
        return [
            ['test_none_class_name'],
        ];
    }
}
