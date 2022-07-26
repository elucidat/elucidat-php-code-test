<?php

namespace App;

class GildedRose
{
    private $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function getItem($which = null)
    {
        return ($which === null
            ? $this->items
            : $this->items[$which]
        );
    }

    public function nextDay()
    {
        foreach ($this->items as $item) {
            switch($item->name) {
                case 'normal' : $this->normal($item); break;
                case 'Aged Brie' : $this->agedBrie($item); break;
                case 'Sulfuras, Hand of Ragnaros' : $this->sulfuras($item); break;
                case 'Backstage passes to a TAFKAL80ETC concert' : $this->passes($item);  break;
                case 'Conjured Mana Cake' : $this->conjured($item); break;
            }
        }
    }

    public function normal($item) {
        if ($item->quality > 0) { $item->quality -= 1; }
        $item->sellIn -= 1;
        if ($item->sellIn < 0) {
            if ($item->quality > 0) { $item->quality -= 1; }
        }
    }

    public function agedBrie($item) {
        if ($item->quality < 50) { $item->quality += 1; }
        $item->sellIn -= 1;
        if ($item->sellIn < 0) {
            if ($item->quality < 50) { $item->quality += 1; }
        }
    }

    public function sulfuras($item) {
        return true;
    }

    public function passes($item) {
        if ($item->quality < 50) { 
            $item->quality += 1; 
            if ($item->sellIn < 11) { $item->quality += 1; }
            if ($item->sellIn < 6) { $item->quality += 1; }
        }
        $item->sellIn -= 1;
        if($item->sellIn < 0) {
            $item->quality = 0;
        }
    }

    public function conjured($item) {
        switch(true){
            case ($item->quality > 1) : $item->quality -= 2; break;
            case ($item->quality < 2) : $item->quality = 0;
        }
        $item->sellIn -= 1;
        if ($item->sellIn < 0) {
            switch(true){
                case ($item->quality > 1) : $item->quality -= 2; break;
                case ($item->quality < 2) : $item->quality = 0;
            }
        }
    }
}
