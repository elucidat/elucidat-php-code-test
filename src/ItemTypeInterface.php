<?php

namespace App;

interface ItemTypeInterface 
{
    public function nextDay();
    public function updateQuality();
    public function updateSellIn();
}