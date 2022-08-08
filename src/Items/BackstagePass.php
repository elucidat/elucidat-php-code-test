<?php

namespace App\Items;

use App\Item;

final class BackstagePass
{
    public function itemType(Item $item) {
        return ($item->name == 'Backstage passes to a TAFKAL80ETC concert');
    }

    public function nextDay(Item $item) {
        $quality = 1;
        $sellIn = -1;

        if ($item->sellIn < 1) { 
            $quality = 0 - $item->quality;
        } elseif ($item->sellIn <= 5) { 
            $quality = 3;
        } elseif ($item->sellIn <= 10) { 
            $quality = 2; 
        }

        if($item->quality + $quality >= 50) { 
            $quality = 50 - $item->quality; 
        }

        $item->sellIn += $sellIn;
        $item->quality += $quality;
    }
} 