<?php

namespace App\Items;

use App\Item;

class AgedBrie implements ItemInterface
{

    /**
     * @param Item $item
     */
    public function update(Item $item)
    {
        $item->sellIn -= 1;
        $item->quality = $item->sellIn < 1 ?
            min(50, $item->quality + 2) :
            min(50, $item->quality + 1);
    }
}