<?php

namespace App\Items;

use App\Item;

class BackstagePass extends Item implements ItemInterface
{

    public function update(Item $item)
    {
        $item->sellIn -= 1;
        $this->calculateQuality($item);
    }

    protected function calculateQuality(Item $item)
    {
        if ($item->sellIn < 0) {
            $item->quality = 0;
        } elseif ($this->sellIn > 10) {
            $item->quality += 1;
        } elseif ($this->sellIn > 5) {
            $item->quality += 2;
        } else {
            $item->quality += 3;
        }

        $item->quality = min(50, $item->quality);
    }
}