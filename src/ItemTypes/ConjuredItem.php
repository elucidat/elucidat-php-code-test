<?php

namespace App\ItemTypes;

final class ConjuredItem extends NormalItem
{
    // "Conjured" items degrade in Quality twice as fast as normal items
    protected $degradeAmount = 2;
}
