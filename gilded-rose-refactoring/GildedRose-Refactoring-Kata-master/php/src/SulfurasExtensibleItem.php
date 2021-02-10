<?php

declare(strict_types=1);

namespace GildedRose;

class SulfurasExtensibleItem extends ExtensibleItem
{
    const SULFURAS = 'Sulfuras, Hand of Ragnaros';
    const LEGENDARY_QUALITY = 80;
    
    public function __construct(int $sell_in, int $quality)
    {
        parent::__construct( self::SULFURAS, $sell_in, self::LEGENDARY_QUALITY );
    }
    
    public function update() {
        $this->quality = self::LEGENDARY_QUALITY;
    }

}
