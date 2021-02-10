<?php

declare(strict_types=1);

namespace GildedRose;

class ExtensibleItem extends Item
{
    const MIN_QUALITY = 0;
    const MAX_QUALITY = 50;

    const DEFAULT_ITEM_DOUBLE_QUALITY_DECREASE_SELL_IN_THRESHOLD = 0;

    public function __construct(string $name, int $sell_in, int $quality)
    {
        parent::__construct($name, $sell_in, $quality);
    }
    
    public function update(){
        $this->decreaseSellIn();

        if ($this->quality > self::MIN_QUALITY) {
            $this->decreaseQuality();
        }
        
        if (($this->sell_in < self::DEFAULT_ITEM_DOUBLE_QUALITY_DECREASE_SELL_IN_THRESHOLD) AND ($this->quality > self::MIN_QUALITY)) {
            $this->decreaseQuality();
        }
    }

    public function decreaseSellIn() {
        $this->sell_in -= 1;
    }

    public function increaseQuality() {
        $this->quality += 1;
    }

    public function decreaseQuality() {
        $this->quality -= 1;
    }

}
