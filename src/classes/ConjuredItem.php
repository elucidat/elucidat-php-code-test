<?php

namespace App\classes;

class ConjuredItem extends BaseItem
{
    public function __construct($quality, $sellIn)
    {
        parent::__construct('Conjured Mana Cake', $quality, $sellIn);
    }

    public function dayIncrement()
    {
        $this->quality -= 2;
        if ($this->sellIn <= 0) {
            $this->quality -= 2;
        }

        if ($this->quality <= self::MIN_QUALITY) {
            $this->quality = self::MIN_QUALITY;
        }

        $this->sellIn -= 1;
    }
}