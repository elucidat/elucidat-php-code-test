<?php

namespace App;

class GildedRose
{
    private array $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @param null $which
     * @return array|mixed
     */
    public function getItem($which = null)
    {
        return $this->items[$which] ?? $this->items;
    }

    public function nextDay()
    {
        array_walk($this->items, function ($item) {
            ItemFactory::getInstance($item)->update($item);
        });
    }
}
