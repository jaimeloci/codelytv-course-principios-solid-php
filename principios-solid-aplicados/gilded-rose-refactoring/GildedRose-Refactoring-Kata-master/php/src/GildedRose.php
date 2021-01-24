<?php

declare(strict_types=1);

namespace GildedRose;

final class GildedRose
{

    const AGED_BRIE = 'Aged Brie';
    const BACKSTAGE_PASSES = 'Backstage passes to a TAFKAL80ETC concert';
    const SULFURAS = 'Sulfuras, Hand of Ragnaros';
    
    const MIN_QUALITY = 0;
    const MAX_QUALITY = 50;

    const DEFAULT_ITEM_DOUBLE_QUALITY_DECREASE_SELL_IN_THRESHOLD = 0;

    const AGED_BRIE_DOUBLE_QUALITY_DECREMENT_SELL_IN_THRESHOLD = 0;

    const BACKSTAGE_PASSES_DOUBLE_QUALITY_INCREASE_SELL_IN_THRESHOLD = 10;
    const BACKSTAGE_PASSES_TRIPLE_QUALITY_INCREASE_SELL_IN_THRESHOLD = 5;
    const BACKSTAGE_PASSES_QUALITY_RESET_SELL_IN_THRESHOLD = 0;


    /**
     * @var Item[]
     */
    private $items;

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            if ($item->name != self::AGED_BRIE and $item->name != self::BACKSTAGE_PASSES) {
                if ($item->quality > self::MIN_QUALITY) {
                    if ($item->name != self::SULFURAS) {
                        $item->quality = $item->quality - 1;
                    }
                }
            } else {
                if ($item->quality < self::MAX_QUALITY) {
                    $item->quality = $item->quality + 1;
                    if ($item->name == self::BACKSTAGE_PASSES) {
                        if ($item->sell_in <= self::BACKSTAGE_PASSES_DOUBLE_QUALITY_INCREASE_SELL_IN_THRESHOLD) {
                            if ($item->quality < self::MAX_QUALITY) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                        if ($item->sell_in <= self::BACKSTAGE_PASSES_TRIPLE_QUALITY_INCREASE_SELL_IN_THRESHOLD) {
                            if ($item->quality < self::MAX_QUALITY) {
                                $item->quality = $item->quality + 1;
                            }
                        }
                    }
                }
            }

            if ($item->name != self::SULFURAS) {
                $item->sell_in = $item->sell_in - 1;
            }

            if ($item->sell_in < 0) {
                if ($item->name != self::AGED_BRIE) {
                    if ($item->name != self::BACKSTAGE_PASSES) {
                        if ($item->quality > self::MIN_QUALITY) {
                            if ($item->name != self::SULFURAS) {
                                $item->quality = $item->quality - 1;
                            }
                        }
                    } else {
                        $item->quality = $item->quality - $item->quality;
                    }
                } else {
                    if ($item->quality < self::MAX_QUALITY) {
                        $item->quality = $item->quality + 1;
                    }
                }
            }

            // OJO: revisar el requisito "Conjured" items degrade in Quality twice as fast as normal items."
        }
    }
}
