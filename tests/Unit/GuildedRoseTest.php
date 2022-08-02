<?php

namespace Tests\Unit;

use App\Bridge\Constants\Loot;
use App\Bridge\Constants\LootType;
use App\Items\CheesyItem;
use App\Items\CommonItem;
use App\Items\ConcertTicketItem;
use App\Items\ConjuredItem;
use App\Items\LegendaryItem;
use App\Item;
use App\GildedRose;
use PHPUnit\Framework\TestCase;

class GuildedRoseTest extends TestCase
{
    /**
     * @dataProvider itemProvider
     *
     * @param Item $item
     * @param String $itemType
     * @param integer $expectedQuality
     * @param integer $expectedSellIn
     * @return void
     */
    public function testUpdatesItemCorrectlyForNextDay(
        Item $item,
        String $itemType,
        int $expectedQuality,
        int $expectedSellIn
    ): void {
        $gr = new GildedRose([$item], $itemType);

        $gr->nextDay();

        $this->assertEquals($expectedQuality, $gr->getItem(0)->quality);

        $this->assertEquals($expectedSellIn, $gr->getItem(0)->sellIn);
    }

    public function itemProvider(): array
    {
        return [
            /**
             * Normal items
             */
            'normal item before sell date' => [
                'item' => new CommonItem(Loot::COMMON, 10, 5),
                'itemType' => LootType::COMMON,
                'expectedQuality' => 9,
                'expectedSellIn' => 4,
            ],
            'normal item on sell date' => [
                'item' => new CommonItem(Loot::COMMON, 10, 0),
                'itemType' => LootType::COMMON,
                'expectedQuality' => 8,
                'expectedSellIn' => -1,
            ],
            'normal item after sell date' => [
                'item' => new CommonItem(Loot::COMMON, 10, -5),
                'itemType' => LootType::COMMON,
                'expectedQuality' => 8,
                'expectedSellIn' => -6,
            ],
            'normal item with quality of 0' => [
                'item' => new CommonItem(Loot::COMMON, 0, 5),
                'itemType' => LootType::COMMON,
                'expectedQuality' => 0,
                'expectedSellIn' => 4,
            ],

            /**
             * Brie items
             */
            'brie item before sell date' => [
                'item' => new CheesyItem(Loot::AGED_BRIE, 10, 5),
                'itemType' => LootType::CHEESY,
                'expectedQuality' => 11,
                'expectedSellIn' => 4,
            ],
            'brie item before sell date with maximum quality' => [
                'item' => new CheesyItem(Loot::AGED_BRIE, 50, 5),
                'itemType' => LootType::CHEESY,
                'expectedQuality' => 50,
                'expectedSellIn' => 4,
            ],
            'brie item on sell date' => [
                'item' => new CheesyItem(Loot::AGED_BRIE, 10, 0),
                'itemType' => LootType::CHEESY,
                'expectedQuality' => 12,
                'expectedSellIn' => -1,
            ],
            'brie item on sell date near maximum quality' => [
                'item' => new CheesyItem(Loot::AGED_BRIE, 49, 0),
                'itemType' => LootType::CHEESY,
                'expectedQuality' => 50,
                'expectedSellIn' => -1,
            ],
            'brie item on sell date with maximum quality' => [
                'item' => new CheesyItem(Loot::AGED_BRIE, 50, 0),
                'itemType' => LootType::CHEESY,
                'expectedQuality' => 50,
                'expectedSellIn' => -1,
            ],
            'brie item after sell date' => [
                'item' => new CheesyItem(Loot::AGED_BRIE, 10, -10),
                'itemType' => LootType::CHEESY,
                'expectedQuality' => 12,
                'expectedSellIn' => -11,
            ],
            'brie item after sell date with maximum quality' => [
                'item' => new CheesyItem(Loot::AGED_BRIE, 50, -10),
                'itemType' => LootType::CHEESY,
                'expectedQuality' => 50,
                'expectedSellIn' => -11,
            ],

            /**
             * Sulfuras items
             */
            'sulfuras item before sell date' => [
                'item' => new LegendaryItem(Loot::SULFURAS, 10, 5),
                'itemType' => LootType::LEGENDARY,
                'expectedQuality' => 10,
                'expectedSellIn' => 5,
            ],
            'sulfuras item on sell date' => [
                'item' => new LegendaryItem(Loot::SULFURAS, 10, 5),
                'itemType' => LootType::LEGENDARY,
                'expectedQuality' => 10,
                'expectedSellIn' => 5,
            ],
            'sulfuras item after sell date' => [
                'item' => new LegendaryItem(Loot::SULFURAS, 10, -1),
                'itemType' => LootType::LEGENDARY,
                'expectedQuality' => 10,
                'expectedSellIn' => -1,
            ],

            /**
             * Backstage passes
             */
            'backstage pass long before sell date' => [
                'item' => new ConcertTicketItem(Loot::BACKSTAGE_PASS_TAFKAL80ETC, 10, 11),
                'itemType' => LootType::TICKETS,
                'expectedQuality' => 11,
                'expectedSellIn' => 10,
            ],
            'backstage pass close to sell date' => [
                'item' => new ConcertTicketItem(Loot::BACKSTAGE_PASS_TAFKAL80ETC, 10, 10),
                'itemType' => LootType::TICKETS,
                'expectedQuality' => 12,
                'expectedSellIn' => 9,
            ],
            'backstage pass close to sell date at maximum quality' => [
                'item' => new ConcertTicketItem(Loot::BACKSTAGE_PASS_TAFKAL80ETC, 50, 10),
                'itemType' => LootType::TICKETS,
                'expectedQuality' => 50,
                'expectedSellIn' => 9,
            ],
            'backstage pass very close to sell date' => [
                'item' => new ConcertTicketItem(Loot::BACKSTAGE_PASS_TAFKAL80ETC, 10, 5),
                'itemType' => LootType::TICKETS,
                'expectedQuality' => 13,
                'expectedSellIn' => 4,
            ],
            'backstage pass very close to sell date at maximum quality' => [
                'item' => new ConcertTicketItem(Loot::BACKSTAGE_PASS_TAFKAL80ETC, 50, 5),
                'itemType' => LootType::TICKETS,
                'expectedQuality' => 50,
                'expectedSellIn' => 4,
            ],
            'backstage pass with one day left to sell' => [
                'item' =>  new ConcertTicketItem(Loot::BACKSTAGE_PASS_TAFKAL80ETC, 10, 1),
                'itemType' => LootType::TICKETS,
                'expectedQuality' => 13,
                'expectedSellIn' => 0,
            ],
            'backstage pass with one day left to sell at maximum quality' => [
                'item' =>  new ConcertTicketItem(Loot::BACKSTAGE_PASS_TAFKAL80ETC, 50, 1),
                'itemType' => LootType::TICKETS,
                'expectedQuality' => 50,
                'expectedSellIn' => 0,
            ],
            'backstage pass on sell date' => [
                'item' =>  new ConcertTicketItem(Loot::BACKSTAGE_PASS_TAFKAL80ETC, 10, 0),
                'itemType' => LootType::TICKETS,
                'expectedQuality' => 0,
                'expectedSellIn' => -1,
            ],
            'backstage pass after sell date' => [
                'item' =>  new ConcertTicketItem(Loot::BACKSTAGE_PASS_TAFKAL80ETC, 10, -1),
                'itemType' => LootType::TICKETS,
                'expectedQuality' => 0,
                'expectedSellIn' => -2,
            ],

            /**
             * Conjured items
             */
             'conjured item before sell date' => [
                 'item' => new ConjuredItem(Loot::CONJURED_MANA_CAKE, 10, 10),
                 'itemType' => LootType::CONJURED,
                 'expectedQuality' => 8,
                 'expectedSellIn' => 9,
             ],
             'conjured item at zero quality' => [
                 'item' => new ConjuredItem(Loot::CONJURED_MANA_CAKE, 0, 10),
                 'itemType' => LootType::CONJURED,
                 'expectedQuality' => 0,
                 'expectedSellIn' => 9,
             ],
             'conjured item on sell date' => [
                 'item' => new ConjuredItem(Loot::CONJURED_MANA_CAKE, 10, 0),
                 'itemType' => LootType::CONJURED,
                 'expectedQuality' => 6,
                 'expectedSellIn' => -1,
             ],
             'conjured item on sell date at zero quality' => [
                 'item' => new ConjuredItem(Loot::CONJURED_MANA_CAKE, 0, 0),
                 'itemType' => LootType::CONJURED,
                 'expectedQuality' => 0,
                 'expectedSellIn' => -1,
             ],
             'conjured item after sell date' => [
                 'item' => new ConjuredItem(Loot::CONJURED_MANA_CAKE, 10, -10),
                 'itemType' => LootType::CONJURED,
                 'expectedQuality' => 6,
                 'expectedSellIn' => -11,
             ],
             'conjured item after sell date at zero quality' => [
                 'item' => new ConjuredItem(Loot::CONJURED_MANA_CAKE, 0, -10),
                 'itemType' => LootType::CONJURED,
                 'expectedQuality' => 0,
                 'expectedSellIn' => -11,
             ],
        ];
    }
}
