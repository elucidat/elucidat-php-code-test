<?php

namespace App;

class GildedRose
{
    private $items;

    public function __construct(array $items)
    {
        $list = [];
        foreach($items as $item){
            switch($item['name']) {
                case 'normal':
                    $list[] = new NormalItem($item['quality'], $item['sellIn']);
                    break;
                case 'Aged Brie':
                    $list[] = new BrieItem($item['quality'], $item['sellIn']);
                    break;
                default:
                    $list[] = new Item($item['name'], $item['quality'], $item['sellIn']);
            }
        }
        $this->items = $list;
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
            if($item->name === 'normal' || $item->name === 'Aged Brie'){
                $item->dayIncrement();
            } elseif($item->name === 'Sulfuras, Hand of Ragnaros') {
                $this->sulfurasNextDay($item);
            }elseif($item->name === 'Backstage passes to a TAFKAL80ETC concert') {
                $this->passesNextDay($item);
            }
        }
    }

    public function normalNextDay($item){
        $item->quality -= 1;
        if ($item->sellIn <= 0) {
            $item->quality -= 1;
        }

        if ($item->quality <= 0) {
            $item->quality = 0;
        }

        $item->sellIn -= 1;
    }

    public function brieNextDay($item)
    {
        $item->quality += 1;
        if ($item->sellIn <= 0) {
            $item->quality += 1;
        }

        if ($item->quality > 50) {
            $item->quality = 50;
        }

        $item->sellIn -= 1;
    }

    public function sulfurasNextDay($item)
    {
        // Does nothing
    }

    public function passesNextDay($item)
    {
        $item->quality += 1;
        if ($item->sellIn <= 10) {
            $item->quality += 1;
        }
        if ($item->sellIn <= 5) {
            $item->quality += 1;
        }

        if ($item->sellIn <= 0) {
            $item->quality = 0;
        }

        if ($item->quality > 50) {
            $item->quality = 50;
        }

        $item->sellIn -= 1;
    }
}
