<?php

namespace App\ItemTypes;

use App\Item;

class NormalItem extends Item
{

    protected $degradeAmount = 1;

    public function __construct($quality, $sellIn, $name = 'Normal')
    {
        parent::__construct($name, $quality, $sellIn);
    }

    public function nextDay()
    {
        $this->processQuality();
        $this->processSellin();

        $this->qualityOverrides();
    }

    protected function processQuality()
    {
        // At the end of each day quality is decreased by 1
        // Once the sell by date has passed, quality degrades twice as fast
        if ($this->sellIn > 0) {
            $this->quality = $this->quality - $this->degradeAmount;
        } else {
            $this->quality = $this->quality - ($this->degradeAmount * 2);
        }
    }

    private function qualityOverrides()
    {
        // The Quality of an item is never negative
        if ($this->quality < 0) {
            $this->quality = 0;
        }

        // The Quality of an item is never more than 50
        if ($this->quality > 50) {
            $this->quality = 50;
        }
    }

    protected function processSellin()
    {
        // At the end of each day sellIn is decreased by 1
        $this->sellIn--;
    }

}
