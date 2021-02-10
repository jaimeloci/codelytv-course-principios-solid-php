<?php

require_once __DIR__ . '/../vendor/autoload.php';

use GildedRose\GildedRose;
use GildedRose\ExtensibleItem;
use GildedRose\AgedBrieExtensibleItem;
use GildedRose\BackstagePassExtensibleItem;
use GildedRose\SulfurasExtensibleItem;

echo "OMGHAI!" . PHP_EOL;

$items = array(
    new ExtensibleItem('+5 Dexterity Vest', 10, 20),
    new AgedBrieExtensibleItem(2, 0),
    new ExtensibleItem('Elixir of the Mongoose', 5, 7),
    new SulfurasExtensibleItem(0, 80),
    new SulfurasExtensibleItem(-1, 80),
    new BackstagePassExtensibleItem(15, 20),
    new BackstagePassExtensibleItem(10, 49),
    new BackstagePassExtensibleItem(5, 49),
    // this conjured item does not work properly yet
    new ExtensibleItem('Conjured Mana Cake', 3, 6)
);

$app = new GildedRose($items);

$days = 2;
if (count($argv) > 1) {
    $days = (int) $argv[1];
}

for ($i = 0; $i < $days; $i++) {
    echo("-------- day $i --------" . PHP_EOL);
    echo("name, sellIn, quality" . PHP_EOL);
    foreach ($items as $item) {
        echo $item . PHP_EOL;
    }
    echo PHP_EOL;
    $app->updateQuality();
}
