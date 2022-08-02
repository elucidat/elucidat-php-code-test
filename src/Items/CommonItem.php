<?php

namespace App\Items;

use App\Bridge\Constants\Quality;
use App\Item;

class CommonItem extends Item
{
    public function __construct(String $name, Int $quality, Int $sellIn)
    {
        parent::__construct($name, $quality, $sellIn);
    }

    public static function nextDay(Item $item)
    {
        $item->sellIn--;

        if ($item->quality > Quality::MIN_ITEM_QUALITY) {
            $item->quality--;
        }

        if ($item->quality > Quality::MIN_ITEM_QUALITY && $item->sellIn <= 0) {
            $item->quality--;
        }
    }
}