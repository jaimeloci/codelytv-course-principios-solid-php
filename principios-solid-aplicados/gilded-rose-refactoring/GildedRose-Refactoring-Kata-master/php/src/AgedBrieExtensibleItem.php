<?php

declare(strict_types=1);

namespace GildedRose;

class AgedBrieExtensibleItem extends ExtensibleItem
{
    const AGED_BRIE = 'Aged Brie';
    const AGED_BRIE_DOUBLE_QUALITY_DECREMENT_SELL_IN_THRESHOLD = 0;

    public function __construct(int $sell_in, int $quality)
    {
        parent::__construct( self::AGED_BRIE, $sell_in, $quality);
    }
    
    public function update() {
        $this->decreaseSellIn();
        
        if ($this->quality < parent::MAX_QUALITY) {
            $this->increaseQuality();
        }
        
        if ($this->sell_in < self::AGED_BRIE_DOUBLE_QUALITY_DECREMENT_SELL_IN_THRESHOLD) {
            if ($this->quality < parent::MAX_QUALITY) {
                $this->increaseQuality();
            }
        }
    }

}
