<?php

namespace App\Models;

use App\Enums\ProductType;

class Product extends Item
{
    public string $type;

    public function __construct($name, $quality, $sellIn, $type = ProductType::REGULAR)
    {
        $this->type = $type;
        parent::__construct($name, $quality, $sellIn);
    }
}
