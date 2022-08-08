<?php 

namespace App\Items;

use App\Item;

final class Sulfuras
{
    public function itemType(Item $item) {
        return ($item->name == 'Sulfuras, Hand of Ragnaros');
    }

    public function nextDay(Item $item) {
        return true;
    }
} 