<?php

namespace App;

class NormalItem extends Item
{
    public function __construct($quality, $sellIn)
    {
        parent::__construct('normal', $quality, $sellIn);
    }

    /**
     * Update quality and sellIn values the item to the next day.
     *
     * Ideally this function would be in the Item class and this class wouldn't need to exist,
     * but the specs clearly say not to update it.
     */
    public function nextDay()
    {
        if ($this->quality > 0) {
            $this->quality--;
        }

        $this->sellIn--;

        if ($this->sellIn < 0) {
            if ($this->quality > 0) {
                $this->quality--;
            }
        }
    }
}
