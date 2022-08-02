<?php

namespace App\Items;

use App\Bridge\Constants\Quality;
use App\Item;

class ConcertTicketItem extends Item
{
    public function __construct(String $name, Int $quality, Int $sellIn)
    {
        parent::__construct($name, $quality, $sellIn);
    }

    public static function nextDay(Item $item)
    {
        $item->sellIn--;

        if($item->sellIn < 0) {
            $item->quality = Quality::MIN_ITEM_QUALITY;

            return;
        }

        if ($item->quality < Quality::MAX_ITEM_QUALITY) {
            $item->quality++;
        }

        if ($item->sellIn < 10 && $item->quality < Quality::MAX_ITEM_QUALITY) {
            $item->quality++;
        }

        if ($item->sellIn < 5 && $item->quality < Quality::MAX_ITEM_QUALITY) {
            $item->quality++;
        }
    }
}