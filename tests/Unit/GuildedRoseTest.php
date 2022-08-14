<?php

namespace Tests\Unit;

use App\Item;
use App\GildedRose;
use App\ItemTypes\AgedBrie;
use App\ItemTypes\BackstagePass;
use App\ItemTypes\ConjuredItem;
use App\ItemTypes\LegendaryItem;
use App\ItemTypes\NormalItem;
use PHPUnit\Framework\TestCase;

class GuildedRoseTest extends TestCase
{
    /**
     * @dataProvider itemProvider
     *
     * @param Item $item
     * @param integer $expectedQuality
     * @param integer $expectedSellIn
     * @return void
     */
    public function testUpdatesItemCorrectlyForNextDay(
        Item $item,
        int $expectedQuality,
        int $expectedSellIn
    ): void {
        $gildedRose = new GildedRose([$item]);

        $gildedRose->nextDay();

        $this->assertEquals($expectedQuality, $gildedRose->getItem(0)->quality);

        $this->assertEquals($expectedSellIn, $gildedRose->getItem(0)->sellIn);
    }

    public function itemProvider(): array
    {
        return [
            /**
             * Normal items
             */
            'normal item before sell date' => [
                'item' => new NormalItem(10, 5),
                'expectedQuality' => 9,
                'expectedSellIn' => 4,
            ],
            'normal item on sell date' => [
                'item' => new NormalItem(10, 0),
                'expectedQuality' => 8,
                'expectedSellIn' => -1,
            ],
            'normal item after sell date' => [
                'item' => new NormalItem(10, -5),
                'expectedQuality' => 8,
                'expectedSellIn' => -6,
            ],
            'normal item with quality of 0' => [
                'item' => new NormalItem(0, 5),
                'expectedQuality' => 0,
                'expectedSellIn' => 4,
            ],

            /**
             * Brie items
             */
            'brie item before sell date' => [
                'item' => new AgedBrie(10, 5),
                'expectedQuality' => 11,
                'expectedSellIn' => 4,
            ],
            'brie item before sell date with maximum quality' => [
                'item' => new AgedBrie(50, 5),
                'expectedQuality' => 50,
                'expectedSellIn' => 4,
            ],
            'brie item on sell date' => [
                'item' => new AgedBrie(10, 0),
                'expectedQuality' => 12,
                'expectedSellIn' => -1,
            ],
            'brie item on sell date near maximum quality' => [
                'item' => new AgedBrie(49, 0),
                'expectedQuality' => 50,
                'expectedSellIn' => -1,
            ],
            'brie item on sell date with maximum quality' => [
                'item' => new AgedBrie(50, 0),
                'expectedQuality' => 50,
                'expectedSellIn' => -1,
            ],
            'brie item after sell date' => [
                'item' => new AgedBrie(10, -10),
                'expectedQuality' => 12,
                'expectedSellIn' => -11,
            ],
            'brie item after sell date with maximum quality' => [
                'item' => new AgedBrie(50, -10),
                'expectedQuality' => 50,
                'expectedSellIn' => -11,
            ],

            /**
             * Sulfuras items
             */
            'sulfuras item before sell date' => [
                'item' => new LegendaryItem(10, 5, 'Sulfuras, Hand of Ragnaros'),
                'expectedQuality' => 80,
                'expectedSellIn' => 5,
            ],
            'sulfuras item on sell date' => [
                'item' => new LegendaryItem(10, 5, 'Sulfuras, Hand of Ragnaros'),
                'expectedQuality' => 80,
                'expectedSellIn' => 5,
            ],
            'sulfuras item after sell date' => [
                'item' => new LegendaryItem(10, -1, 'Sulfuras, Hand of Ragnaros'),
                'expectedQuality' => 80,
                'expectedSellIn' => -1,
            ],

            /**
             * Backstage passes
             */
            'backstage pass long before sell date' => [
                'item' => new BackstagePass(10, 11, 'Backstage passes to a TAFKAL80ETC concert'),
                'expectedQuality' => 11,
                'expectedSellIn' => 10,
            ],
            'backstage pass close to sell date' => [
                'item' => new BackstagePass(10, 10, 'Backstage passes to a TAFKAL80ETC concert'),
                'expectedQuality' => 12,
                'expectedSellIn' => 9,
            ],
            'backstage pass close to sell date at maximum quality' => [
                'item' => new BackstagePass(50, 10, 'Backstage passes to a TAFKAL80ETC concert'),
                'expectedQuality' => 50,
                'expectedSellIn' => 9,
            ],
            'backstage pass very close to sell date' => [
                'item' => new BackstagePass(10, 5, 'Backstage passes to a TAFKAL80ETC concert'),
                'expectedQuality' => 13,
                'expectedSellIn' => 4,
            ],
            'backstage pass very close to sell date at maximum quality' => [
                'item' => new BackstagePass(50, 5, 'Backstage passes to a TAFKAL80ETC concert'),
                'expectedQuality' => 50,
                'expectedSellIn' => 4,
            ],
            'backstage pass with one day left to sell' => [
                'item' =>  new BackstagePass(10, 1, 'Backstage passes to a TAFKAL80ETC concert'),
                'expectedQuality' => 13,
                'expectedSellIn' => 0,
            ],
            'backstage pass with one day left to sell at maximum quality' => [
                'item' =>  new BackstagePass(50, 1, 'Backstage passes to a TAFKAL80ETC concert'),
                'expectedQuality' => 50,
                'expectedSellIn' => 0,
            ],

            // I would say this test is wrong and that expectedQuality should be 13 as I would interpret 0 as the day of
            // the concert. I have left it in case this is not the case, however I would say this is wrong.
            'backstage pass on sell date' => [
                'item' =>  new BackstagePass(10, 0, 'Backstage passes to a TAFKAL80ETC concert'),
                'expectedQuality' => 0,
                'expectedSellIn' => -1,
            ],
            'backstage pass after sell date' => [
                'item' =>  new BackstagePass(10, -1, 'Backstage passes to a TAFKAL80ETC concert'),
                'expectedQuality' => 0,
                'expectedSellIn' => -2,
            ],

            /**
             * Conjured items
             */
             'conjured item before sell date' => [
                 'item' => new ConjuredItem(10, 10, 'Conjured Mana Cake'),
                 'expectedQuality' => 8,
                 'expectedSellIn' => 9,
             ],
             'conjured item at zero quality' => [
                 'item' => new ConjuredItem(0, 10, 'Conjured Mana Cake'),
                 'expectedQuality' => 0,
                 'expectedSellIn' => 9,
             ],
             'conjured item on sell date' => [
                 'item' => new ConjuredItem(10, 0, 'Conjured Mana Cake'),
                 'expectedQuality' => 6,
                 'expectedSellIn' => -1,
             ],
             'conjured item on sell date at zero quality' => [
                 'item' => new ConjuredItem(0, 0, 'Conjured Mana Cake'),
                 'expectedQuality' => 0,
                 'expectedSellIn' => -1,
             ],
             'conjured item after sell date' => [
                 'item' => new ConjuredItem(10, -10, 'Conjured Mana Cake'),
                 'expectedQuality' => 6,
                 'expectedSellIn' => -11,
             ],
             'conjured item after sell date at zero quality' => [
                 'item' => new ConjuredItem(0, -10, 'Conjured Mana Cake'),
                 'expectedQuality' => 0,
                 'expectedSellIn' => -11,
             ],
        ];
    }
}
