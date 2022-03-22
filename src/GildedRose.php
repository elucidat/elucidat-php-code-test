<?php

namespace App;

use App\Enums\ProductDefaults;
use App\Enums\ProductType;
use App\Exceptions\UnknownProductException;
use App\Interfaces\NextDayLogicInterface;
use App\Models\Product;

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
        /** @var Product $product */
        foreach ($this->items as $product) {

            if (!$product instanceof Models\Product) {
                throw new UnknownProductException('All the items in a collection should be the type of Item');
            }

            // Process sell in days and quality
            /** @var string|NextDayLogicInterface $typeClass */
            $typeClass = ProductType::getNextDayLogicClass($product->type);  // Get logic class for the given item
            $typeClass::nextDay($product);                                   // Calculate item's next day Quality and SelIn value

            // Enforce minimum Quality
            if ($product->quality < ProductDefaults::MIN_QUALITY) {
                $product->quality = ProductDefaults::MIN_QUALITY;
            }

            // Enforce maximum Quality
            if ($product->quality > $typeClass::maxQuality()) {
                $product->quality = $typeClass::maxQuality();
            }

        }
    }
}
