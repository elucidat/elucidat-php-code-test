<?php

namespace App;

class GildedRose
{
    private $items;
    private $itemType;

    public function __construct(array $items, String $itemType)
    {
        $this->items = $items;
        $this->itemType = $itemType;
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
            $itemClass = 'App\Items\\'. $this->itemType . 'Item';
            $ic = new $itemClass($item->name, $item->quality, $item->sellIn);
            $ic->nextDay($item);
        }
    }
}
