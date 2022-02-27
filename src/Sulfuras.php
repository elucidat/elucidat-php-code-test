<?php

namespace App;

class Sulfuras implements ItemTypeInterface {

    public $item;

    function __construct($item)
    {
        $this->item = $item;
    }

    function nextDay()
    {

    }

    function updateQuality()
    {
        // Item type does not degrade in quality
    }

    function updateSellIn()
    {
        // Item never needs to be sold
    }

}