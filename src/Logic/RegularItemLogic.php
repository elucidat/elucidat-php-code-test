<?php

namespace App\Logic;

use App\Enums\ProductDefaults;
use App\Interfaces\NextDayLogicInterface;
use App\Models\Product;

class RegularItemLogic implements NextDayLogicInterface
{
    /**
     * Normal items degrade in Quality, 1 per day
     *
     * @param  Product  $product
     *
     * @return void
     */
    public static function nextDay(Product $product)
    {
        $product->sellIn--;

        if ($product->sellIn < 0) {
            $product->quality -= ProductDefaults::DAILY_QUALITY_DECREASE * 2;
        } else {
            $product->quality -= ProductDefaults::DAILY_QUALITY_DECREASE;
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
