<?php

namespace App\Items;

use App\Item;

class BackstagePassItem extends Item {

    public $name;
    public $sellIn;
    public $quality;

    public function nextDay()
    {
        $this->updateQuality();
        $this->updateSellIn();        
    }

    private function updateQuality(){

        if( $this->sellIn > 10)
        {
           $this->quality = min([$this->quality + 1, 50]);
        }
        elseif( $this->sellIn > 5)
        {
            $this->quality = min([$this->quality + 2, 50]);
        }    
        elseif( $this->sellIn > 0)
        {
            $this->quality = min([$this->quality + 3, 50]);
        }    
        else 
        {
            $this->quality = 0;
        }
    }

    private function updateSellin(){
        $this->sellIn = $this->sellIn - 1;
    }

}