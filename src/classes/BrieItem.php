<?php

namespace App\classes;

class BrieItem extends BaseItem
{
    public function __construct($quality, $sellIn)
    {
        parent::__construct('Aged Brie', $quality, $sellIn);
    }

    public function dayIncrement()
    {
        $this->quality += 1;
        if ($this->sellIn <= 0) {
            $this->quality += 1;
        }

        if ($this->quality > self::MAX_QUALITY) {
            $this->quality = self::MAX_QUALITY;
        }

        $this->sellIn -= 1;
    }
}