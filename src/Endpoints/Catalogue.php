<?php

namespace RenokiGames\Runescape\Endpoints;

use Carbon\Carbon;
use RenokiGames\Runescape\Client;

class Catalogue extends Client
{
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
                ->values()
                ->toArray();

            $graph['average'] = collect($graph['average'])
                ->keyBy(fn ($price, $key) => Carbon::createFromTimestamp($key)->format($format))
                ->sortBy(fn ($price, $key) => $key)
                ->values()
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
