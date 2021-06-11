<?php

namespace App\Items;

use App\Items\NormalItem;

class BrieItem extends NormalItem {

    public $name;
    public $sellIn;
    public $quality;

    public function nextDay()
    {
        $this->updateQuality();
        $this->updateSellIn();        
    }

    protected function updateQuality(){
        
        if( $this->sellIn < 1)
        {
            $this->quality = min([$this->quality + 2, 50]);
        }
        else
        {
            $this->quality = min([$this->quality + 1, 50]);
        }    
        
    }

}