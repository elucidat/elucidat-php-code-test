<?php

namespace App\Logic;

use App\Enums\ProductDefaults;
use App\Interfaces\NextDayLogicInterface;
use App\Models\Product;

class AgingItemLogic implements NextDayLogicInterface
{
    /**
     * Aging items (ie. Aged Brie) increases in Quality the older it gets
     *
     * @param  Product  $product
     *
     * @return void
     */
    public static function nextDay(Product $product)
    {
        $product->sellIn--;
        $product->quality++;

        if ($product->sellIn < 0) {
            $product->quality++;
        }
    }

    /**
     * @parentdoc
     *
     * @param  Product  $product
     *
     * @return void
     */
    public static function nextDaySellIn(Product $product)
    {

    }

    /**
     * Maximum quality for the item of this type
     *
     * @return int
     */
    public static function maxQuality(): int
    {
        return ProductDefaults::MAX_QUALITY;
    }
}
