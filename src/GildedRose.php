<?php

namespace App;

class GildedRose
{
    private $items;

    // Keeping inline with SOLID priciples, this array can be updated to accept new product types
    private static $itemTypes = [
        'Aged Brie' => AgedBrie::class,
        'Sulfuras, Hand of Ragnaros'  => Sulfuras::class,
        'Backstage passes to a TAFKAL80ETC concert' => BackstagePasses::class,
        'Conjured Mana Cake'  => Conjured::class
    ];

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
            if(array_key_exists($item->name, self::$itemTypes)){
                $item = new self::$itemTypes[$item->name]($item);
            } else {
                $item = new Normal($item);
            }
            // Process the "next day" scenario
            $item->nextDay();
        }
    }
}
