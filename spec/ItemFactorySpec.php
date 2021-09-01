<?php

use App\Items\AgedBrie;
use App\Items\BackstagePass;
use App\Items\Conjured;
use App\Item;
use App\ItemFactory;
use App\Items\StandardItem;
use App\Items\Sulfuras;

describe('Item Factory', function () {
    describe('Get Item child class from parent', function () {
        context('Get child Item instance', function () {
            it('gets a StandardItem item instance', function () {
                expect(ItemFactory::getInstance(new Item('standarditem', 10, 5)))
                    ->toBeAnInstanceOf(StandardItem::class);
            });

            it('gets an AgedBrie item instance', function () {
                expect(ItemFactory::getInstance(new Item(ItemFactory::ITEM_NAME_AGED_BRIE, 10, 5)))
                    ->toBeAnInstanceOf(AgedBrie::class);
            });

            it('gets an BackstagePass item instance', function () {
                expect(ItemFactory::getInstance(new Item(ItemFactory::ITEM_NAME_BACKSTAGE_PASS, 10, 5)))
                    ->toBeAnInstanceOf(BackstagePass::class);
            });

            it('gets an Sulfuras item instance', function () {
                expect(ItemFactory::getInstance(new Item(ItemFactory::ITEM_NAME_SULFURAS, 10, 5)))
                    ->toBeAnInstanceOf(Sulfuras::class);
            });

            it('gets an Conjured item instance', function () {
                expect(ItemFactory::getInstance(new Item(ItemFactory::ITEM_NAME_CONJURED, 10, 5)))
                    ->toBeAnInstanceOf(Conjured::class);
            });
        });
    });
});