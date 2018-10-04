<?php

namespace App\Models;

use App\Models\Interfaces\CompositeInterface;

abstract class CompositeUnit implements CompositeInterface
{
    /**
     * Units that instance of this class should be composed of
     * @var array
     */
    protected $units;
}
