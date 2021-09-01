<?php


namespace App;

use App\Items\AgedBrie;
use App\Items\BackstagePass;
use App\Items\Conjured;
use App\Items\ItemInterface;
use App\Items\StandardItem;
use App\Items\Sulfuras;

class ItemFactory
{
    const ITEM_NAME_AGED_BRIE = 'Aged Brie';
    const ITEM_NAME_BACKSTAGE_PASS = 'Backstage passes to a TAFKAL80ETC concert';
    const ITEM_NAME_SULFURAS = 'Sulfuras, Hand of Ragnaros';
    const ITEM_NAME_CONJURED = 'Conjured Mana Cake';
    const ITEM_NAME_DEFAULT = 'Default';

    private static $classMap = [
        self::ITEM_NAME_AGED_BRIE => AgedBrie::class,
        self::ITEM_NAME_BACKSTAGE_PASS => BackstagePass::class,
        self::ITEM_NAME_SULFURAS => Sulfuras::class,
        self::ITEM_NAME_CONJURED => Conjured::class,
        self::ITEM_NAME_DEFAULT => StandardItem::class,
    ];

    public static function getInstance(Item $item): ItemInterface
    {
        $class = self::$classMap[$item->name] ?? self::$classMap[self::ITEM_NAME_DEFAULT];

        return new $class ($item->name, $item->quality, $item->sellIn);
    }

}