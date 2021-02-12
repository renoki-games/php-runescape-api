<?php

namespace RenokiGames\Runescape\Test;

use RenokiGames\Runescape\Facade as Runescape;

class CatalogueTest extends TestCase
{
    public function test_alphas()
    {
        $alphas = Runescape::catalogue()->getAlphas(1);

        foreach ($alphas['alpha'] as $letter) {
            $this->assertTrue(is_int($letter['items']));
        }
    }

    public function test_items()
    {
        $page = 1;
        $items = Runescape::catalogue()->getItems(12, 'a', $page);

        while ($items['items']) {
            foreach ($items['items'] as $item) {
                $this->assertNotNull($item['name']);
            }

            $items = Runescape::catalogue()->getItems(12, 'a', $page++);
        }
    }

    public function test_item()
    {
        $item = Runescape::catalogue()->getItem(21787)['item'];

        $this->assertNotNull($item['name']);
    }

    public function test_item_images()
    {
        $bigImage = Runescape::catalogue()->getItemBigImage(21787);
        $spriteImage = Runescape::catalogue()->getItemSpriteImage(21787);

        $this->assertNotNull($bigImage);
        $this->assertNotNull($spriteImage);
    }

    public function test_item_graph()
    {
        $graph = Runescape::catalogue()->getItemPriceGraph(21787, 'Y-m-d H:i:s');

        foreach ($graph['daily'] as $time => $price) {
            $this->assertTrue(is_int($price));
        }

        foreach ($graph['average'] as $time => $price) {
            $this->assertTrue(is_int($price));
        }
    }
}
