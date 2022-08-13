<?php

namespace Tests\Unit;

use App\Item;
use App\Items\AgedItem;
use App\Items\LegendaryItem;
use App\Items\BackstagePassItem;
use App\Items\ConjuredItem;
use App\InventoryManager;
use PHPUnit\Framework\TestCase;

class InventoryManagerTest extends TestCase
{
    /**
     * @dataProvider itemTypeProvider
     *
     * @param Item $item
     * @param boolean $expectedAgedItem
     * @param boolean $expectedBackstagePassItem
     * @param boolean $expectedConjuredItem
     * @param boolean $expectedLegendaryItem
     * @return void
     */
    public function testForCorrectItemType(
        Item $item,
        bool $expectedAgedItem,
        bool $expectedBackstagePassItem,
        bool $expectedConjuredItem,
        bool $expectedLegendaryItem
    ): void
    {
        $im = new InventoryManager($item);

        $this->assertEquals($im->isAgedItem(), $expectedAgedItem);
        $this->assertEquals($im->isBackstagePassItem(), $expectedBackstagePassItem);
        $this->assertEquals($im->isConjuredItem(), $expectedConjuredItem);
        $this->assertEquals($im->isLegendaryItem(), $expectedLegendaryItem);
    }

    public function itemTypeProvider(): array
    {
        return [
            'normal items should not be classed as special items' => [
                'item' => new Item('normal', 5, 5),
                'expectedAgedItem' => false,
                'expectedBackstagePassItem' => false,
                'expectedConjuredItem' => false,
                'expectedLegendaryItem' => false,
            ],
            'brie item should be aged' => [
                'item' => new AgedItem('Aged Brie', 5, 5),
                'expectedAgedItem' => true,
                'expectedBackstagePassItem' => false,
                'expectedConjuredItem' => false,
                'expectedLegendaryItem' => false,
            ],
            'sulfuras item should be legendary' => [
                'item' => new LegendaryItem('Sulfuras, Hand of Ragnaros', 5, 5),
                'expectedAgedItem' => false,
                'expectedBackstagePassItem' => false,
                'expectedConjuredItem' => false,
                'expectedLegendaryItem' => true,
            ],
            'concert item should be backstage pass' => [
                'item' => new BackstagePassItem('Backstage passes to a TAFKAL80ETC concert', 10, 11),
                'expectedAgedItem' => false,
                'expectedBackstagePassItem' => true,
                'expectedConjuredItem' => false,
                'expectedLegendaryItem' => false,
            ],
            'mana cake item should be conjured' => [
                'item' => new ConjuredItem('Conjured Mana Cake', 10, -10),
                'expectedAgedItem' => false,
                'expectedBackstagePassItem' => false,
                'expectedConjuredItem' => true,
                'expectedLegendaryItem' => false,
            ],
        ];
    }

    /**
     * @dataProvider itemQualityIncreaseProvider
     *
     * @param Item $item
     * @param int $expectedResult
     * @return void
     */
    public function testItemQualityIncreaseCalculation(
        Item $item,
        int $expectedResult
    ): void
    {
        $im = new InventoryManager($item);
        $im->increaseQuality();
        $item = $im->getItem();

        $this->assertEquals($item->quality, $expectedResult);
    }

    /**
     * @dataProvider itemQualityDecreaseProvider
     *
     * @param Item $item
     * @param int $expectedResult
     * @return void
     */
    public function testItemQualityDecreaseCalculation(
        Item $item,
        int $expectedResult
    ): void
    {
        $im = new InventoryManager($item);
        $im->decreaseQuality();
        $item = $im->getItem();

        $this->assertEquals($item->quality, $expectedResult);
    }

    /**
     * @dataProvider itemSellinDecreaseProvider
     *
     * @param Item $item
     * @param int $expectedResult
     * @return void
     */
    public function testItemSellinDecreaseCalculation(
        Item $item,
        int $expectedResult
    ): void
    {
        $im = new InventoryManager($item);
        $im->decreaseSellin();
        $item = $im->getItem();

        $this->assertEquals($item->sellIn, $expectedResult);
    }

    public function itemQualityIncreaseProvider(): array
    {
        return [
            'item quality should be increased when less than 50' => [
                'item' => new Item('normal', 5, 5),
                'expectedResult' => 6,
            ],
            'item quality should not be increased when equal to 50' => [
                'item' => new Item('normal', 50, 5),
                'expectedResult' => 50,
            ],
            'item quality should not be increased when greater than 50' => [
                'item' => new Item('normal', 150, 5),
                'expectedResult' => 150,
            ],
        ];
    }

    public function itemQualityDecreaseProvider(): array
    {
        return [
            'item quality should be decreased' => [
                'item' => new Item('normal', 5, 5),
                'expectedResult' => 4,
            ],
            'item quality should be decreased twice for conjured items' => [
                'item' => new ConjuredItem('Conjured Mana Cake', 5, 5),
                'expectedResult' => 3,
            ],
        ];
    }

    public function itemSellinDecreaseProvider(): array
    {
        return [
            'item sellIn should be decreased' => [
                'item' => new Item('normal', 5, 5),
                'expectedResult' => 4,
            ],
        ];
    }
}
