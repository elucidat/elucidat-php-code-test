<?php

namespace App\Interfaces;

use App\Models\Product;

interface NextDayLogicInterface
{
    /**
     * Calculate Product next day Quality and SellIn value
     *
     * @param  Product  $product
     *
     * @return void
     */
    public static function nextDay(Product $product);

    /**
     * Returns maximum Quality for the Product
     *
     * @return int
     */
    public static function maxQuality(): int;
}
