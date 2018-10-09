<?php

namespace Tests\App\Models\SoldierTest;

use Tests\App\Models\SoldierTest;

class IncrementExperienceTest extends SoldierTest
{
    /**
     * Test incrementExperience method
     *
     * @covers \App\Models\Soldier::incrementExperience()
     */
    public function testIncrementExperience()
    {
        $expectedValue = 1;

        $this->soldier->incrementExperience();
        $this->assertEquals($expectedValue, $this->soldier->getExperience());
    }
}
