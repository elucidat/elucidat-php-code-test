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
                case 'Sulfuras, Hand of Ragnaros':
                    $list[] = new SulfurasItem($item['quality'], $item['sellIn']);
                    break;
                case 'Backstage passes to a TAFKAL80ETC concert':
                    $list[] = new PassesItem($item['quality'], $item['sellIn']);
                    break;
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
            $item->dayIncrement();
        }
    }
}
