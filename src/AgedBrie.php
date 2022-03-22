<?php

namespace App;

class AgedBrie extends Item
{
    public function __construct($quality, $sellIn)
    {
        parent::__construct('Aged Brie', $quality, $sellIn);
    }

    /**
     * Update quality and sellIn values the item to the next day
     */
    public function nextDay()
    {
        if ($this->quality < 50) {
            $this->quality++;
        }

        $this->sellIn--;

        if ($this->sellIn < 0) {
            if ($this->quality < 50) {
                $this->quality++;
            }
        }
    }
}
