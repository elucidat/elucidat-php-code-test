<?php

namespace App;

class Sulfuras extends Item
{
    public function __construct($sellIn)
    {
        parent::__construct('Sulfuras, Hand of Ragnaros', 80, $sellIn);
    }

    /**
     * Update quality and sellIn values the item to the next day.
     * Sulfuras never changes in quality or sell date, so nothing happens here.
     */
    public function nextDay()
    {
        // do nothing
    }
}
