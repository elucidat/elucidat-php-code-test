<?php

namespace App\Items;

use App\Item;

class SulfurasItem extends Item {

    public $name;
    public $sellIn;
    public $quality;

    public function nextDay()
    {
        //empty method as does not change sellIn or quality 
    }

}