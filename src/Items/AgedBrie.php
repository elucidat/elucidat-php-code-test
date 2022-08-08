<?php

namespace App\Items;

use App\Item;

final class AgedBrie 
{
    public function itemType(Item $item) {
        return ($item->name == 'Aged Brie');
    }

    public function nextDay(Item $item) {
        $quality = 1; $sellIn = -1;

        $item->sellIn += $sellIn;
        
        if($item->sellIn < 1) { 
            $quality = 2; 
        }

        if($item->quality + $quality > 50) { 
            $quality = 50 - $item->quality; 
        }
        
        $item->quality += $quality;
    }
} 