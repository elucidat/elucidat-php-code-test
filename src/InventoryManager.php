<?php

namespace App;
use App\Items;

class InventoryManager
{
    private $item;
    const MAX_QUALITY = 50;

    public function __construct(object $item)
    {
        $this->item = $item;
    }

    public function nextDay()
    {
        if (! $this->isAgedItem() && ! $this->isBackstagePassItem()) {
            if ($this->item->quality > 0) {
                if (! $this->isLegendaryItem()) {
                    $this->decreaseQuality();
                }
            }
        } else {
            $this->increaseQuality();
            if ($this->isBackstagePassItem()) {
                if ($this->item->sellIn <= $this->item::TEN_DAYS_TO_EVENT_DATE) {
                    $this->increaseQuality();
                }
                if ($this->item->sellIn <= $this->item::FIVE_DAYS_TO_EVENT_DATE) {
                    $this->increaseQuality();
                }
            }
        }

        if (! $this->isLegendaryItem()) {
            $this->decreaseSellin();
        }

        if ($this->item->sellIn < 0) {
            if ($this->isAgedItem()) {
                $this->increaseQuality();
            }

            if (! $this->isAgedItem()) {
                if (! $this->isBackstagePassItem()) {
                    if ($this->item->quality > 0) {
                        if (! $this->isLegendaryItem()) {
                            $this->decreaseQuality();
                        }
                    }
                } else {
                    $this->item->quality -= $this->item->quality;
                }
            }
        }
    }

    public function isAgedItem() 
    {
        return $this->item instanceof Items\AgedItem;
    }

    public function isBackstagePassItem() 
    {
        return $this->item instanceof Items\BackstagePassItem;
    }

    public function isConjuredItem() 
    {
        return $this->item instanceof Items\ConjuredItem;
    }

    public function isLegendaryItem() 
    {
        return $this->item instanceof Items\LegendaryItem;
    }

    public function increaseQuality() 
    {
        if ($this->item->quality < self::MAX_QUALITY) {
            $this->item->quality++;
        }
    }

    public function decreaseQuality() 
    {
        $this->item->quality--;
        if ($this->isConjuredItem()) {
            $this->item->quality--;
        }
    }

    public function decreaseSellin() 
    {
        $this->item->sellIn--;
    }

    public function getItem() 
    {
        return $this->item;
    }

}
