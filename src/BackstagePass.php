<?php

namespace App;

class BackstagePass extends Item
{
    public function __construct($quality, $sellIn)
    {
        parent::__construct('Backstage passes to a TAFKAL80ETC concert', $quality, $sellIn);
    }

    /**
     * Update quality and sellIn values the item to the next day
     */
    public function nextDay()
    {
        if ($this->quality < 50) {
            $this->quality = $this->quality + 1;

            if ($this->sellIn < 11) {
                if ($this->quality < 50) {
                    $this->quality = $this->quality + 1;
                }
            }
            if ($this->sellIn < 6) {
                if ($this->quality < 50) {
                    $this->quality = $this->quality + 1;
                }
            }
        }

        $this->sellIn = $this->sellIn - 1;

        if ($this->sellIn < 0) {
            $this->quality = $this->quality - $this->quality;
        }
    }
}
