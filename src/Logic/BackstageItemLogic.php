<?php

namespace App\Logic;

use App\Enums\ProductDefaults;
use App\Interfaces\NextDayLogicInterface;
use App\Models\Product;

class BackstageItemLogic implements NextDayLogicInterface
{
    /**
     * ByDate items (ie. backstage passes), like aged brie, increases in Quality as its SellIn value approaches;
     * Quality increases by 2 when there are 10 days or less and by 3 when there are 5 days or less but Quality drops
     * to 0 after the conce
     *
     * @param  Product  $product
     *
     * @return void
     */
    public static function nextDay(Product $product)
    {
        $daysToExpire = $product->sellIn;

        $product->quality++;

        if ($daysToExpire <= 5) {
            $product->quality++;
        }

        if ($daysToExpire <= 10) {
            $product->quality++;
        }

        if ($daysToExpire <= 0) {
            $product->quality = 0;
        }

        $product->sellIn--;
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
