<?php

declare(strict_types=1);

namespace Tests;

use GildedRose\GildedRose;
use GildedRose\Item;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{

    public function testThatSellInValueIsDecreased():void 
    {
        $items = [new Item('whatever', 10, 0)];

        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertEquals(9, $items[0]->sell_in);
    }

    public function testThatQualityValueIsDecreased():void 
    {
        $items = [new Item('whatever', 1, 10)];

        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertEquals(9, $items[0]->quality);
    }

    public function testThatQualityDecreasesTwiceAsMuchWhenSellByIsPassed():void 
    {
        $items = [new Item('whatever', 0, 10)];

        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertEquals(8, $items[0]->quality);
    }

    public function testThatQualityIsNeverNegative():void 
    {
        $items = [new Item('whatever', 0, 0)];

        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertEquals(0, $items[0]->quality);
    }

    public function testAgedBrieIncreasesQualityWithAge():void 
    {
        $items = [new Item('Aged Brie', 5, 1)];

        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertEquals(2, $items[0]->quality);
    }

    public function testQualityNeverIncreasesPastFifty():void 
    {
        $items = [new Item('Aged Brie', 5, 50)];

        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();

        $this->assertEquals(50, $items[0]->quality);
    }
    
    public function testSulfurasNeverChanges():void 
    {
        $items = [new Item("Sulfuras, Hand of Ragnaros", 0, 25)];
        
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        $gildedRose->updateQuality();
        
        $this->assertEquals(25, $items[0]->quality);
        $this->assertEquals(0, $items[0]->sell_in);
    }
    
    public function testBackstagePassIncreasesQualityByOneIfSellByGreaterThenTen():void 
    {
        $items = [new Item("Backstage passes to a TAFKAL80ETC concert", 11, 20)];
        
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        
        $this->assertEquals(21, $items[0]->quality);
    }
    
    public function testBackstagePassIncreasesQualityByTwoIfSellBySmallerThanTen():void 
    {
        $items = [new Item("Backstage passes to a TAFKAL80ETC concert", 6, 20)];
        
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        
        $this->assertEquals(22, $items[0]->quality);
    }
    
    public function testBackstagePassIncreasesQualityByThreeIfSellBySmallerThanFive():void 
    {
        $items = [new Item("Backstage passes to a TAFKAL80ETC concert", 5, 20)];
        
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        
        $this->assertEquals(23, $items[0]->quality);
    }
    
    public function testBackstagePassLosesValueAfterSellByPasses():void 
    {
        $items = [new Item("Backstage passes to a TAFKAL80ETC concert", 0, 20)];
        
        $gildedRose = new GildedRose($items);
        $gildedRose->updateQuality();
        
        $this->assertEquals(0, $items[0]->quality);
    }
    
}
