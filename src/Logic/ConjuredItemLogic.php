<?php

namespace App\Logic;

use App\Enums\ProductDefaults;
use App\Interfaces\NextDayLogicInterface;
use App\Models\Product;

class ConjuredItemLogic implements NextDayLogicInterface
{
    /**
     * Conjured items degrade in Quality twice as fact as normal items
     *
     * @param  Product  $product
     *
     * @return void
     */
    public static function nextDay(Product $product)
    {
        $product->sellIn--;

        if ($product->sellIn < 0) {
            $product->quality -= ProductDefaults::DAILY_QUALITY_DECREASE * 4;
        } else {
            $product->quality -= ProductDefaults::DAILY_QUALITY_DECREASE * 2;
        }
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
