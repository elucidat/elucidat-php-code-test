<?php 

namespace App\Items;

use App\Item;

final class Normal
{
    public function itemType(Item $item) {
        return ($item->name == 'Normal item');
    }

    public function nextDay(Item $item) {
        $quality = -1;
        $sellIn = -1;

        $item->sellIn += $sellIn;
        if($item->sellIn < 1) { 
            $quality = -2; 
        }

        if($item->quality + $quality < 0) { 
            $item->quality = abs($quality); 
        }
        
        $item->quality += $quality;
    }
} 