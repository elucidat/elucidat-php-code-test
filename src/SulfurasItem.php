<?php

namespace App;

class SulfurasItem extends BaseItem
{
    public function __construct($quality, $sellIn)
    {
        parent::__construct('Sulfuras, Hand of Ragnaros', $quality, $sellIn);
    }

    public function dayIncrement()
    {
        //Do NOTHING
    }
}