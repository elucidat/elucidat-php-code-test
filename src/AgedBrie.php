<?php

namespace App;

class AgedBrie implements ItemTypeInterface{

    public $item;

    function __construct($item)
    {
        $this->item = $item;
    }

    function nextDay()
    {
        $this->updateSellIn();
        $this->updateQuality();
    }

    function updateSellIn()
    {
        $this->item->sellIn -= 1;
    }

    function updateQuality()
    {
        // Deduct 1 quality before sellIn date, 2 from then on
        $this->item->quality += ($this->item->sellIn > 0 ? 1 : 2);
        
        // Restrict quality at 50 (top)
        if($this->item->quality > 50) $this->item->quality = 50;
    }
}