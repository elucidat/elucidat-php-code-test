<?php

use App\Item;
use App\GildedRose;

describe('Gilded Rose', function () {
    describe('next day', function () {
        context('normal Items', function () {
            it('updates normal items before sell date', function () {
                $gr = new GildedRose([['name'=>'normal',  'quality'=>10, 'sellIn'=>5]]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(9);
                expect($gr->getItem(0)->sellIn)->toBe(4);
            });
            it('updates normal items on the sell date', function () {
                $gr = new GildedRose([['name'=>'normal',  'quality'=>10, 'sellIn'=>0]]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(8);
                expect($gr->getItem(0)->sellIn)->toBe(-1);
            });
            it('updates normal items after the sell date', function () {
                $gr = new GildedRose([['name'=>'normal',  'quality'=>10, 'sellIn'=>-5]]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(8);
                expect($gr->getItem(0)->sellIn)->toBe(-6);
            });
            it('updates normal items with a quality of 0', function () {
                $gr = new GildedRose([['name'=>'normal',  'quality'=>0, 'sellIn'=>5]]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(0);
                expect($gr->getItem(0)->sellIn)->toBe(4);
            });
            it('adds 2 and updates 2 normal items before sell date', function () {
                $gr = new GildedRose([['name'=>'normal', 'quality'=>10, 'sellIn'=>5], ['name'=>'normal', 'quality'=>15, 'sellIn'=>6]]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(9);
                expect($gr->getItem(0)->sellIn)->toBe(4);
                expect($gr->getItem(1)->quality)->toBe(14);
                expect($gr->getItem(1)->sellIn)->toBe(5);
            });
        });
        context('Brie Items', function () {
            it('updates Brie items before the sell date', function () {
                $gr = new GildedRose([['name'=>'Aged Brie',  'quality'=>10, 'sellIn'=>5]]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(11);
                expect($gr->getItem(0)->sellIn)->toBe(4);
            });
            it('updates Brie items before the sell date with maximum quality', function () {
                $gr = new GildedRose([['name'=>'Aged Brie',  'quality'=>50, 'sellIn'=>5]]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(50);
                expect($gr->getItem(0)->sellIn)->toBe(4);
            });
            it('updates Brie items on the sell date', function () {
                $gr = new GildedRose([['name'=>'Aged Brie',  'quality'=>10, 'sellIn'=>0]]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(12);
                expect($gr->getItem(0)->sellIn)->toBe(-1);
            });
            it('updates Brie items on the sell date, near maximum quality', function () {
                $gr = new GildedRose([['name'=>'Aged Brie',  'quality'=>49, 'sellIn'=>0]]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(50);
                expect($gr->getItem(0)->sellIn)->toBe(-1);
            });
            it('updates Brie items on the sell date with maximum quality', function () {
                $gr = new GildedRose([['name'=>'Aged Brie',  'quality'=>50, 'sellIn'=>0]]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(50);
                expect($gr->getItem(0)->sellIn)->toBe(-1);
            });
            it('updates Brie items after the sell date', function () {
                $gr = new GildedRose([['name'=>'Aged Brie',  'quality'=>10, 'sellIn'=>-10]]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(12);
                expect($gr->getItem(0)->sellIn)->toBe(-11);
            });
            it('updates Brie items after the sell date with maximum quality', function () {
                $gr = new GildedRose([['name'=>'Aged Brie',  'quality'=>50, 'sellIn'=>-10]]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(50);
                expect($gr->getItem(0)->sellIn)->toBe(-11);
            });
        });
        context('Sulfuras Items', function () {
            it('updates Sulfuras items before the sell date', function () {
                $gr = new GildedRose([['name'=>'Sulfuras, Hand of Ragnaros',  'quality'=>10, 'sellIn'=>5]]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(10);
                expect($gr->getItem(0)->sellIn)->toBe(5);
            });
            it('updates Sulfuras items on the sell date', function () {
                $gr = new GildedRose([['name'=>'Sulfuras, Hand of Ragnaros',  'quality'=>10, 'sellIn'=>5]]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(10);
                expect($gr->getItem(0)->sellIn)->toBe(5);
            });
            it('updates Sulfuras items after the sell date', function () {
                $gr = new GildedRose([['name'=>'Sulfuras, Hand of Ragnaros',  'quality'=>10, 'sellIn'=>-1]]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(10);
                expect($gr->getItem(0)->sellIn)->toBe(-1);
            });
        });
        context('Backstage Passes', function () {
            it('updates Backstage pass items long before the sell date', function () {
                $gr = new GildedRose([['name'=>'Backstage passes to a TAFKAL80ETC concert',  'quality'=>10, 'sellIn'=>11]]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(11);
                expect($gr->getItem(0)->sellIn)->toBe(10);
            });
            it('updates Backstage pass items close to the sell date', function () {
                $gr = new GildedRose([['name'=>'Backstage passes to a TAFKAL80ETC concert',  'quality'=>10, 'sellIn'=>10]]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(12);
                expect($gr->getItem(0)->sellIn)->toBe(9);
            });
            it('updates Backstage pass items close to the sell data, at max quality', function () {
                $gr = new GildedRose([['name'=>'Backstage passes to a TAFKAL80ETC concert',  'quality'=>50, 'sellIn'=>10]]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(50);
                expect($gr->getItem(0)->sellIn)->toBe(9);
            });
            it('updates Backstage pass items very close to the sell date', function () {
                $gr = new GildedRose([['name'=>'Backstage passes to a TAFKAL80ETC concert',  'quality'=>10, 'sellIn'=>5]]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(13); // goes up by 3
                expect($gr->getItem(0)->sellIn)->toBe(4);
            });
            it('updates Backstage pass items very close to the sell date, at max quality', function () {
                $gr = new GildedRose([['name'=>'Backstage passes to a TAFKAL80ETC concert',  'quality'=>50, 'sellIn'=>5]]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(50);
                expect($gr->getItem(0)->sellIn)->toBe(4);
            });
            it('updates Backstage pass items with one day left to sell', function () {
                $gr = new GildedRose([['name'=>'Backstage passes to a TAFKAL80ETC concert',  'quality'=>10, 'sellIn'=>1]]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(13);
                expect($gr->getItem(0)->sellIn)->toBe(0);
            });
            it('updates Backstage pass items with one day left to sell, at max quality', function () {
                $gr = new GildedRose([['name'=>'Backstage passes to a TAFKAL80ETC concert',  'quality'=>50, 'sellIn'=>1]]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(50);
                expect($gr->getItem(0)->sellIn)->toBe(0);
            });
            it('updates Backstage pass items on the sell date', function () {
                $gr = new GildedRose([['name'=>'Backstage passes to a TAFKAL80ETC concert',  'quality'=>10, 'sellIn'=>0]]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(0);
                expect($gr->getItem(0)->sellIn)->toBe(-1);
            });
            it('updates Backstage pass items after the sell date', function () {
                $gr = new GildedRose([['name'=>'Backstage passes to a TAFKAL80ETC concert',  'quality'=>10, 'sellIn'=>-1]]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(0);
                expect($gr->getItem(0)->sellIn)->toBe(-2);
            });
        });
        context("Conjured Items", function () {
            it('updates Conjured items before the sell date', function () {
                $gr = new GildedRose([['name'=>'Conjured Mana Cake',  'quality'=>10, 'sellIn'=>10]]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(8);
                expect($gr->getItem(0)->sellIn)->toBe(9);
            });
            it('updates Conjured items at zero quality', function () {
                $gr = new GildedRose([['name'=>'Conjured Mana Cake',  'quality'=>0, 'sellIn'=>10]]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(0);
                expect($gr->getItem(0)->sellIn)->toBe(9);
            });
            it('updates Conjured items on the sell date', function () {
                $gr = new GildedRose([['name'=>'Conjured Mana Cake',  'quality'=>10, 'sellIn'=>0]]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(6);
                expect($gr->getItem(0)->sellIn)->toBe(-1);
            });
            it('updates Conjured items on the sell date at 0 quality', function () {
                $gr = new GildedRose([['name'=>'Conjured Mana Cake',  'quality'=>0, 'sellIn'=>0]]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(0);
                expect($gr->getItem(0)->sellIn)->toBe(-1);
            });
            it('updates Conjured items after the sell date', function () {
                $gr = new GildedRose([['name'=>'Conjured Mana Cake',  'quality'=>10, 'sellIn'=>-10]]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(6);
                expect($gr->getItem(0)->sellIn)->toBe(-11);
            });
            it('updates Conjured items after the sell date at zero quality', function () {
                $gr = new GildedRose([['name'=>'Conjured Mana Cake',  'quality'=>0, 'sellIn'=>-10]]);
                $gr->nextDay();
                expect($gr->getItem(0)->quality)->toBe(0);
                expect($gr->getItem(0)->sellIn)->toBe(-11);
            });
        });
    });
});
