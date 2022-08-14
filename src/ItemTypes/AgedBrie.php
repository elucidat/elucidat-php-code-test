<?php

namespace App\ItemTypes;

use App\Item;

final class AgedBrie extends NormalItem
{

    public function __construct($quality, $sellIn)
    {
        parent::__construct($quality, $sellIn, 'Aged Brie');
    }

    protected function processQuality()
    {
        if ($this->sellIn > 0) {
            $this->quality++;
        } else {
            $this->quality = $this->quality + 2;
        }
    }

}
