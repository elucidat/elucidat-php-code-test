<?php

namespace App\Items;

use App\Item;

class NormalItem extends Item {

    public $name;
    public $sellIn;
    public $quality;

    public function nextDay()
    {
        $this->updateQuality();
        $this->updateSellIn();        
    }

    private function updateQuality(){

        if($this->quality === 0 ) return;

        if( $this->sellIn > 1)
        {
            $this->quality = $this->quality - 1;
        }
        else
        {
            $this->quality = $this->quality - 2;
        }
    }

    private function updateSellin(){
        $this->sellIn = $this->sellIn - 1;
    }

}