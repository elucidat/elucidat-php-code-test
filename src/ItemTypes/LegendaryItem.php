<?php

namespace App\ItemTypes;

final class LegendaryItem extends NormalItem
{
    public function __construct($quality, $sellIn, $name)
    {
        parent::__construct(80, $sellIn, $name);
    }

    public function nextDay(){
        return;
    }
}
