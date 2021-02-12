<?php

namespace RenokiGames\Runescape\Endpoints;

use Carbon\Carbon;
use RenokiGames\Runescape\Client;

class Catalogue extends Client
{
    public function getAlphas(string $category)
    {
        return $this->query(['category' => $category])
            ->get('/catalogue/category.json')
            ->json();
    }

    public function getItems(string $category, string $alpha, int $page = 1)
    {
        return $this->query([
            'category' => $category,
            'alpha' => $alpha,
            'page' => $page,
        ])->get('/catalogue/items.json')->json();
    }

    public function getItem(string $id)
    {
        return $this->query(['item' => $id])
            ->get('/catalogue/detail.json')
            ->json();
    }

    public function getItemPriceGraph(string $id, string $format = null)
    {
        $graph = $this->get("/graph/{$id}.json")->json();

        if ($format) {
            $graph['daily'] = collect($graph['daily'])
                ->keyBy(fn ($price, $key) => Carbon::createFromTimestamp($key)->format($format))
                ->sortBy(fn ($price, $key) => $key)
                ->toArray();

            $graph['average'] = collect($graph['average'])
                ->keyBy(fn ($price, $key) => Carbon::createFromTimestamp($key)->format($format))
                ->sortBy(fn ($price, $key) => $key)
                ->toArray();
        }

        return $graph;
    }

    public function getItemBigImage(string $id)
    {
        return "https://services.runescape.com/m=itemdb_rs/obj_big.gif?id={$id}";
    }

    public function getItemSpriteImage(string $id)
    {
        return "https://services.runescape.com/m=itemdb_rs/obj_sprite.gif?id={$id}";
    }
}
