<?php

namespace App;

class PassesItem extends BaseItem
{
    public function __construct($quality, $sellIn)
    {
        parent::__construct('Backstage passes to a TAFKAL80ETC concert', $quality, $sellIn);
    }

    public function dayIncrement()
    {
        $this->quality += 1;

        //
        if ($this->sellIn <= 10) {
            $this->quality += 1;
        }

        if ($this->sellIn <= 5) {
            $this->quality += 1;
        }

        if ($this->sellIn <= 0) {
            $this->quality = self::MIN_QUALITY;
        }

        if ($this->quality > self::MAX_QUALITY) {
            $this->quality = self::MAX_QUALITY;
        }

        $this->sellIn -= 1;
    }
}