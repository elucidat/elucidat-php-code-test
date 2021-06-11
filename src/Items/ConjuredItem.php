<?php

namespace App\Items;

use App\Items\NormalItem;

class ConjuredItem extends NormalItem {

    public $name;
    public $sellIn;
    public $quality;

    protected function updateQuality(){

        if( $this->sellIn > 1)
        {
            $this->quality = max([$this->quality - 2, 0]);
        }
        else
        {
            $this->quality = max([$this->quality - 4, 0]);
        }
    }
}