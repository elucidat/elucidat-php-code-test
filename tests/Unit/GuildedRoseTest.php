<?php

use App\GildedRose;
use App\Item;
use PHPUnit\Framework\TestCase;

class GuildedRoseTest extends TestCase
{
    /**
     * @dataProvider provider
     *
     * @param Item $item
     * @param integer $expectedQuality
     * @param integer $expectedSellIn
     * @return void
     */
    public function testNextDay(
        Item $item,
        int $expectedQuality,
        int $expectedSellIn
    ): void {
        $test = new GildedRose([$item]);
        $test->nextDay();
        $this->assertEquals($expectedSellIn, $test->getItem(0)->sellIn);
        $this->assertEquals($expectedQuality, $test->getItem(0)->quality);
    }

    public function provider(): array
    {
        return [
            'sulfuras item before sell date' => [
                'item' => new Item('Sulfuras, Hand of Ragnaros', 10, 5),
                'expectedQuality' => 10,
                'expectedSellIn' => 5,
            ],
            'normal item before sell date' => [
                'item' => new Item('Normal item', 10, 5),
                'expectedQuality' => 9,
                'expectedSellIn' => 4,
            ],
            'conjured item before sell date' => [
                'item' => new Item('Conjured Mana Cake', 10, 10),
                'expectedQuality' => 8,
                'expectedSellIn' => 9,
            ],
            'brie item before sell date' => [
                'item' => new Item('Aged Brie', 10, 5),
                'expectedQuality' => 11,
                'expectedSellIn' => 4,
            ],
            'brie item before sell date with maximum quality' => [
                'item' => new Item('Aged Brie', 50, 5),
                'expectedQuality' => 50,
                'expectedSellIn' => 4,
            ],
            'backstage before sell date' => [
                'item' => new Item('Backstage passes to a TAFKAL80ETC concert', 10, 11),
                'expectedQuality' => 11,
                'expectedSellIn' => 10,
            ],
            'conjured item at only one quality before sell date' => [
                'item' => new Item('Conjured Mana Cake', 1, 10),
                'expectedQuality' => 0,
                'expectedSellIn' => 9,
            ],
            'normal item on sell date' => [
                'item' => new Item('Normal item', 10, 0),
                'expectedQuality' => 8,
                'expectedSellIn' => -1,
            ],
            'sulfuras on sell date' => [
                'item' => new Item('Sulfuras, Hand of Ragnaros', 10, 5),
                'expectedQuality' => 10,
                'expectedSellIn' => 5,
            ],
            'brie on sell date' => [
                'item' => new Item('Aged Brie', 10, 0),
                'expectedQuality' => 12,
                'expectedSellIn' => -1,
            ],
            'backstage on sell date' => [
                'item' =>  new Item('Backstage passes to a TAFKAL80ETC concert', 10, 0),
                'expectedQuality' => 0,
                'expectedSellIn' => -1,
            ],
            'conjured on sell date' => [
                'item' => new Item('Conjured Mana Cake', 10, 0),
                'expectedQuality' => 6,
                'expectedSellIn' => -1,
            ],
            'sulfuras after sell date' => [
                'item' => new Item('Sulfuras, Hand of Ragnaros', 10, -1),
                'expectedQuality' => 10,
                'expectedSellIn' => -1,
            ],
            'normal item after sell date' => [
                'item' => new Item('Normal item', 10, -5),
                'expectedQuality' => 8,
                'expectedSellIn' => -6,
            ],
            'backstage after sell date' => [
                'item' =>  new Item('Backstage passes to a TAFKAL80ETC concert', 10, -1),
                'expectedQuality' => 0,
                'expectedSellIn' => -2,
            ],
            'brie after sell date' => [
                'item' => new Item('Aged Brie', 10, -10),
                'expectedQuality' => 12,
                'expectedSellIn' => -11,
            ],
            'conjured after sell date' => [
                'item' => new Item('Conjured Mana Cake', 10, -10),
                'expectedQuality' => 6,
                'expectedSellIn' => -11,
            ],
            'conjured at only one quality after sell date' => [
                'item' => new Item('Conjured Mana Cake', 1, -10),
                'expectedQuality' => 0,
                'expectedSellIn' => -11,
            ],
            'conjured at zero quality' => [
                'item' => new Item('Conjured Mana Cake', 0, 10),
                'expectedQuality' => 0,
                'expectedSellIn' => 9,
            ],
            'conjured on sell date at zero quality' => [
                'item' => new Item('Conjured Mana Cake', 0, 0),
                'expectedQuality' => 0,
                'expectedSellIn' => -1,
            ],
            'conjured after sell date at zero quality' => [
                'item' => new Item('Conjured Mana Cake', 0, -10),
                'expectedQuality' => 0,
                'expectedSellIn' => -11,
            ],
            'brie on sell date near maximum quality' => [
                'item' => new Item('Aged Brie', 49, 0),
                'expectedQuality' => 50,
                'expectedSellIn' => -1,
            ],
            'brie on sell date with maximum quality' => [
                'item' => new Item('Aged Brie', 50, 0),
                'expectedQuality' => 50,
                'expectedSellIn' => -1,
            ],
            'brie after sell date with maximum quality' => [
                'item' => new Item('Aged Brie', 50, -10),
                'expectedQuality' => 50,
                'expectedSellIn' => -11,
            ],
            'backstage close to sell date' => [
                'item' => new Item('Backstage passes to a TAFKAL80ETC concert', 10, 10),
                'expectedQuality' => 12,
                'expectedSellIn' => 9,
            ],
            'backstage close to sell date at maximum quality' => [
                'item' => new Item('Backstage passes to a TAFKAL80ETC concert', 50, 10),
                'expectedQuality' => 50,
                'expectedSellIn' => 9,
            ],
            'backstage close to sell date' => [
                'item' => new Item('Backstage passes to a TAFKAL80ETC concert', 10, 5),
                'expectedQuality' => 13,
                'expectedSellIn' => 4,
            ],
            'backstage close to sell date at maximum quality' => [
                'item' => new Item('Backstage passes to a TAFKAL80ETC concert', 50, 5),
                'expectedQuality' => 50,
                'expectedSellIn' => 4,
            ],
            'backstage with one day left to sell' => [
                'item' =>  new Item('Backstage passes to a TAFKAL80ETC concert', 10, 1),
                'expectedQuality' => 13,
                'expectedSellIn' => 0,
            ],
            'backstage with one day left to sell at maximum quality' => [
                'item' =>  new Item('Backstage passes to a TAFKAL80ETC concert', 50, 1),
                'expectedQuality' => 50,
                'expectedSellIn' => 0,
            ],
            'normal with quality of 0' => [
                'item' => new Item('Normal item', 0, 5),
                'expectedQuality' => 0,
                'expectedSellIn' => 4,
            ],
        ];
    }
}