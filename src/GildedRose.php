<?php

namespace App;

class GildedRose
{
    private $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function getItem($which = null)
    {
        return ($which === null
            ? $this->items
            : $this->items[$which]
        );
    }

    public function nextDay()
    {
        foreach ($this->items as $item) {
            $itemType = 'standard';
            $testItemName = strtolower($item->name);

            if (strpos($testItemName, 'conjured') !==  false) {
                $itemType = "conjured";
            } else if (strpos($testItemName, 'brie') !==  false) {
                $itemType = 'brie';
            } else if (strpos($testItemName, 'sulfuras') !==  false) {
                $itemType = 'sulfuras';
            } else if (strpos($testItemName, 'backstage passes') !==  false) {
                $itemType = 'backstage';
            }

            switch ($itemType) {
                case 'conjured':
                    $item = $this->conjuredItemBehaviour($item);
                    $item->sellIn -= 1;
                    break;
                case 'brie':     
                    $item = $this->brieItemBehaviour($item);
                    $item->sellIn -= 1;
                    break;
                case 'sulfuras':      
                    $item = $this->sulfurasItemBehaviour($item);
                    break;
                case 'backstage':   
                    $item = $this->backstageItemBehaviour($item);                 
                    $item->sellIn -= 1;
                    break;
                default:
                    $item = $this->defaultItemBehaviour($item);
                    $item->sellIn -= 1;
                    break;
            }
        }
    }

    public function applyQualityCaps($item){
        $item->quality = min($item->quality, 50);
        $item->quality = max($item->quality, 0);

        return $item;
    }

    public function genericItemRules($item){
        if($item->sellIn <= 0 ) {
            $item->quality = $item->quality -= 2 ;
        }else{
            $item->quality = $item->quality -= 1;
        }

        $item = $this->applyQualityCaps($item);

        return $item;
    }

    public function defaultItemBehaviour($item){
        $item = $this->genericItemRules($item);

        return $item;
    }

    public function conjuredItemBehaviour($item){
        if($item->sellIn <= 0 ) {
            $item->quality = $item->quality -= 4 ;
        }else{
            $item->quality = $item->quality -= 2;
        }
        $item = $this->applyQualityCaps($item);
        return $item;
    }

    public function brieItemBehaviour($item){
        if ($item->sellIn <= 0 ) {
            $item->quality += 2;
        } else {
            $item->quality += 1;
        }

        $item = $this->applyQualityCaps($item);
        return $item;
    }

    public function backstageItemBehaviour($item){
        
        if ($item->sellIn > 10) {
            $item->quality += 1 ;
        }

        if ($item->sellIn <= 10 && $item->sellIn > 5) {
            $item->quality += 2;
        }
         
        if ($item->sellIn <= 5) {
            $item->quality += 3 ;
        }

        if($item->sellIn <= 0){
            $item->quality = $item->quality - $item->quality;
        }
        
        $item = $this->applyQualityCaps($item);
        return $item;
    }

    public function sulfurasItemBehaviour($item){
        $item->quality = 80;
        return $item;
    }

}
