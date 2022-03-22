<?php

namespace App\Logic;

use App\Interfaces\NextDayLogicInterface;
use App\Models\Product;

class LegendaryItemLogic implements NextDayLogicInterface
{
    const LEGENDARY_QUALITY = 80;

    /**
     * Quality for Legendary item is always 80
     *
     * @param  Product  $product
     *
     * @return void
     */
    public static function nextDay(Product $product)
    {
        // It's legendary, so it never changed. Mighty.
    }

    /**
     * Maximum quality for Legendary item is 80
     *
     * @return int
     */
    public static function maxQuality(): int
    {
        return self::LEGENDARY_QUALITY;
    }
}
