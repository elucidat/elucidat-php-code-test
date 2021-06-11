<?php

namespace App\Items;

use App\Items\NormalItem;

class SulfurasItem extends NormalItem {

    public $name;
    public $sellIn;
    public $quality;

    public function nextDay()
    {
        //empty method as does not change sellIn or quality 
    }

}