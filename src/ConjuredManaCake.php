<?php

namespace App;

class ConjuredManaCake extends Item
{
    public function __construct($quality, $sellIn)
    {
        parent::__construct('Conjured Mana Cake', $quality, $sellIn);
    }

    /**
     * Update quality and sellIn values the item to the next day
     */
    public function nextDay()
    {
        if ($this->quality > 0) {
            $this->quality -= 2;
        }

        $this->sellIn--;

        if ($this->sellIn < 0) {
            if ($this->quality > 0) {
                $this->quality -= 2;
            }
        }

        if ($this->quality < 0) {
            $this->quality = 0;
        }
    }
}
