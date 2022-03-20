<?php

namespace App\classes;

use App\interfaces\DayIncrementInterface;

abstract class BaseItem extends Item implements DayIncrementInterface
{
    const MAX_QUALITY = 50;
    const MIN_QUALITY = 0;

    public function dayIncrement()
    {
        // TODO: Implement dayIncrement() method.
    }
}