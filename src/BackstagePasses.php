<?php

namespace App;

class BackstagePasses implements ItemTypeInterface{

    public $item;

    function __construct($item)
    {
        $this->item = $item;
    }

    function nextDay()
    {
        $this->updateQuality();
        $this->updateSellIn();
    }

    function updateSellIn()
    {
        $this->item->sellIn -= 1;
    }

    function updateQuality()
    {
        // Restrict quality at 50 (top)
        if($this->item->quality >= 50) {
            $this->item->quality = 50;
            return;
        }

        // Restrict quality at 0 (bottom)
        if($this->item->sellIn <= 0) {
            $this->item->quality = 0;
            return;
        }

        if($this->item->sellIn <= 6){
            $qualityInc = 3;
        } elseif($this->item->sellIn < 11){
            $qualityInc = 2;
        } else {
            $qualityInc = 1;
        }

        $this->item->quality += $qualityInc;
    }
}