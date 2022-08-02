<?php

namespace App\Items;

use App\Bridge\Constants\Quality;
use App\Item;

class CheesyItem extends Item
{
    public function __construct(String $name, Int $quality, Int $sellIn)
    {
        parent::__construct($name, $quality, $sellIn);

        $this->name = $quality;
        $this->sellIn = $sellIn;
    }

    public static function nextDay(Item $item)
    {
        $item->sellIn--;

        if ($item->quality < Quality::MAX_ITEM_QUALITY) {
            $item->quality++;
        }

        if ($item->sellIn < 0 && $item->quality < Quality::MAX_ITEM_QUALITY) {
            $item->quality++;
        }
    }
}