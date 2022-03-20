<?php

namespace App\classes;

class NormalItem extends BaseItem
{
    public function __construct($quality, $sellIn)
    {
        parent::__construct('normal', $quality, $sellIn);
    }

    public function dayIncrement()
    {
        $this->quality -= 1;
        if ($this->sellIn <= 0) {
            $this->quality -= 1;
        }

        if ($this->quality <= self::MIN_QUALITY) {
            $this->quality = self::MIN_QUALITY;
        }

        $this->sellIn -= 1;
    }
}