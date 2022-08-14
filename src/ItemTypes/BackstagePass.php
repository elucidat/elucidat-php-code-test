<?php

namespace App\ItemTypes;

final class BackstagePass extends NormalItem
{

    protected function processQuality()
    {
        if ($this->sellIn <= 0) {
            // Quality drops to 0 after the concert
            $this->quality = 0;
        } elseif ($this->sellIn <= 5 ) {
            // Quality increases by 3 when there are 5 days or less
            $this->quality = $this->quality + 3;
        } elseif ($this->sellIn <= 10) {
            // Quality increases by 2 when there are 10 days or less
            $this->quality = $this->quality + 2;
        } else {
            // "Backstage passes", like aged brie, increases in Quality as its SellIn value approaches
            $this->quality++;
        }
    }

}
