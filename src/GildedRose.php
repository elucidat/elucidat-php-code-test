<?php

namespace App;

use App\Items;

class GildedRose
{
    private $items;
    private $itemTypes = [];

    public function __construct(array $items, array $itemTypes = null)
    {
        $this->items = $items;

        if($itemTypes === NULL) {
            $itemTypes = [
                new Items\AgedBrie,
                new Items\BackstagePass,
                new Items\Conjured,
                new Items\Normal,
                new Items\Sulfuras,
            ];
        }

        $this->itemTypes = $itemTypes;
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
            $itemFound = true;
            
            foreach ($this->itemTypes as $type) {
                if ($type->itemType($item)) {
                    $type->nextDay($item);
                    $itemFound = false;
                }
            }

            if($itemFound) {
                throw new \UnexpectedValueException(
                    print "$item not found"
                );
            }
        }
    }
}

