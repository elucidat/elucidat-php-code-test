<?php

namespace App;

class Conjured implements ItemTypeInterface{

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
        // Deduct 2 quality before sellIn date, 4 from then on
        $this->item->quality -= ($this->item->sellIn > 0 ? 2 : 4);

        // Restrict quality at 50 (top)
        if($this->item->quality > 50) $this->item->quality = 50;

        // Restrict quality at 0 (bottom)
        if($this->item->quality < 0) $this->item->quality = 0;
    }
}