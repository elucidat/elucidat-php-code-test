<?php

namespace App\Items;

use App\Item;

interface ItemInterface
{
    public function update(Item $item);
}