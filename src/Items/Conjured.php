<?php 

namespace App\Items;

use App\Item;

final class Conjured
{
    public function itemType(Item $item) {
        return ($item->name == 'Conjured Mana Cake');
    }

    public function nextDay(Item $item) {
        $quality = -2;
        $sellIn = -1;

        $item->sellIn += $sellIn;
        if($item->sellIn < 1) { 
            $quality = -4; 
        }

        if($item->quality + $quality < 0) { 
            $item->quality = abs($quality); 
        }
        
        $item->quality += $quality;
    }
} 