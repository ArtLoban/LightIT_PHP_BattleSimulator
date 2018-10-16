<?php

namespace Tests\Services\ClassFactory\FactoryTest;

use App\Models\Soldier;
use Tests\Services\ClassFactory\FactoryTest;

class CreateSuccessTest extends FactoryTest
{
    /**
     * Test create method
     *
     * @covers \Services\ClassFactory\Factory::create()
     * @dataProvider createDataProvider
     */
    public function testCreateSuccess(string $className)
    {
        $instance = $this->factory->create($className);

        $this->assertInstanceOf($className, $instance);
    }

    /**
     * @return array
     */
    public function createDataProvider(): array
    {
        return [
            [Soldier::class],
        ];
    }
}
