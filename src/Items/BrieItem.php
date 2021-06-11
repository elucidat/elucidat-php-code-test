<?php

namespace App\Items;

use App\Item;

class BrieItem extends Item {

    public $name;
    public $sellIn;
    public $quality;

    public function nextDay()
    {
        $this->updateQuality();
        $this->updateSellIn();        
    }

    private function updateQuality(){
        
        if( $this->sellIn < 1)
        {
            $this->quality = min([$this->quality + 2, 50]);
        }
        else
        {
            $this->quality = min([$this->quality + 1, 50]);
        }    
        
    }

    private function updateSellin(){
        $this->sellIn = $this->sellIn - 1;
    }

}