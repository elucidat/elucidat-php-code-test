<?php

namespace App\Items;

use App\Bridge\Constants\Quality;
use App\Item;

class ConjuredItem extends Item
{
    public function __construct(String $name, Int $quality, Int $sellIn)
    {
        parent::__construct($name, $quality, $sellIn);
    }

    public static function nextDay(Item $item)
    {
        $item->sellIn--;

        if ($item->sellIn < 0) {
            $item->quality-=4;
        } else {
            $item->quality-=2 ;
        }

        if($item->quality < Quality::MIN_ITEM_QUALITY) {
            $item->quality = Quality::MIN_ITEM_QUALITY;
        }
    }
}