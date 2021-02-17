<?php

namespace RenokiGames\Runescape\Test;

use RenokiGames\Runescape\Facade as Runescape;

class CatalogueTest extends TestCase
{
    public function test_item()
    {
        $item = Runescape::catalogue()->getItem(1511)['item'];

        $this->assertNotNull($item['name']);
    }

    public function test_item_images()
    {
        $bigImage = Runescape::catalogue()->getItemBigImage(1511);
        $spriteImage = Runescape::catalogue()->getItemSpriteImage(1511);

        $this->assertNotNull($bigImage);
        $this->assertNotNull($spriteImage);
    }

    public function test_item_graph()
    {
        $graph = Runescape::catalogue()->getItemPriceGraph(1511, 'Y-m-d H:i:s');

        foreach ($graph['daily'] as $time => $price) {
            $this->assertTrue(is_int($price));
        }

        foreach ($graph['average'] as $time => $price) {
            $this->assertTrue(is_int($price));
        }
    }
}
