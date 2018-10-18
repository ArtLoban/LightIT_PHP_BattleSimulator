<?php

namespace Tests\App\Models\SoldierTest;

use Tests\App\Models\SoldierTest;

class IncrementExperienceTest extends SoldierTest
{
    /**
     * Test incrementExperience method
     * Initial experience value is 0
     *
     * @covers \App\Models\Soldier::incrementExperience()
     */
    public function testIncrementExperience()
    {
        $this->soldier->incrementExperience();

        $this->assertEquals(1, $this->soldier->getExperience());
    }
}
