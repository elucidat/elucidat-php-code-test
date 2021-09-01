<?php

namespace App\Items;

use App\Item;

class StandardItem extends Item implements ItemInterface
{
    public function update(Item $item)
    {
        $item->sellIn -= 1;
        $item->quality = $item->sellIn < 1 ?
            max(0, $item->quality - 2) :
            max(0, $item->quality - 1);
    }
}