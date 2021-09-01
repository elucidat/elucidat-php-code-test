<?php

namespace App\Items;

use App\Item;

class Conjured extends Item implements ItemInterface
{

    public function update(Item $item)
    {
        $item->sellIn -= 1;
        $item->quality = $item->sellIn < 1 ?
            max(0, $item->quality - 4) :
            max(0, $item->quality - 2);
    }
}