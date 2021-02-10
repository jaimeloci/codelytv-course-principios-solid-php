<?php

declare(strict_types=1);

namespace GildedRose;

class BackstagePassExtensibleItem extends ExtensibleItem
{
    const BACKSTAGE_PASSES = 'Backstage passes to a TAFKAL80ETC concert';

    const BACKSTAGE_PASSES_DOUBLE_QUALITY_INCREASE_SELL_IN_THRESHOLD = 10;
    const BACKSTAGE_PASSES_TRIPLE_QUALITY_INCREASE_SELL_IN_THRESHOLD = 5;
    const BACKSTAGE_PASSES_QUALITY_RESET_SELL_IN_THRESHOLD = 0;

    public function __construct(int $sell_in, int $quality)
    {
        parent::__construct( self::BACKSTAGE_PASSES, $sell_in, $quality);
    }
    
    public function update() {
        $this->decreaseSellIn();
        
        if ($this->quality < parent::MAX_QUALITY) {
            $this->increaseQuality();
   
            if ($this->sell_in < self::BACKSTAGE_PASSES_DOUBLE_QUALITY_INCREASE_SELL_IN_THRESHOLD) {
                if ($this->quality < parent::MAX_QUALITY) {
                    $this->increaseQuality();
                }
            }
            if ($this->sell_in < self::BACKSTAGE_PASSES_TRIPLE_QUALITY_INCREASE_SELL_IN_THRESHOLD) {
                if ($this->quality < parent::MAX_QUALITY) {
                    $this->increaseQuality();
                }
            }
            
        }
    
        if ($this->sell_in < self::DEFAULT_ITEM_DOUBLE_QUALITY_DECREASE_SELL_IN_THRESHOLD) {   
            $this->quality = 0;
        }
    }

}
