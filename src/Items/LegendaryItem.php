<?php

namespace App\Items;

use App\Item;

class LegendaryItem extends Item
{
    public function __construct(String $name, Int $quality, Int $sellIn)
    {
        parent::__construct($name, $quality, $sellIn);
    }

    public static function nextDay(Item $item)
    {

    }
}