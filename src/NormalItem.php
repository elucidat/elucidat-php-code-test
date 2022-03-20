<?php

namespace App;

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

        if ($this->quality <= parent::MIN_QUALITY) {
            $this->quality = parent::MIN_QUALITY;
        }

        $this->sellIn -= 1;
    }
}