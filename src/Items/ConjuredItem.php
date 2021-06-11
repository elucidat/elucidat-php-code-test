<?php

namespace App\Items;

use App\Item;

class ConjuredItem extends Item {

    public $name;
    public $sellIn;
    public $quality;

    public function nextDay()
    {
        $this->updateQuality();
        $this->updateSellIn();        
    }

    private function updateQuality(){

        if( $this->sellIn > 1)
        {
            $this->quality = max([$this->quality - 2, 0]);
        }
        else
        {
            $this->quality = max([$this->quality - 4, 0]);
        }
    }

    private function updateSellin(){
        $this->sellIn = $this->sellIn - 1;
    }

}