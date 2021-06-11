<?php

namespace App\Items;

use App\Items\NormalItem;

class BackstagePassItem extends NormalItem {

    public $name;
    public $sellIn;
    public $quality;

    protected function updateQuality(){

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

}