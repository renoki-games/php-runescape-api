<?php

namespace RenokiGames\Runescape\Endpoints;

use Carbon\Carbon;
use RenokiGames\Runescape\Client;

class Graph extends Client
{
    /**
     * The base URL for the calls.
     *
     * @var string
     */
    protected static $baseUrl = 'https://api.weirdgloop.org/';

    public function getAllTimePrices(string $id, string $format = null)
    {
        $response = $this->query(['id' => $id, 'compress' => 'true'])
            ->get('/exchange/history/osrs/all')
            ->json();

        return $this->processGraph($response, $id, $format);
    }

    public function getLast90DaysGraph(string $id, string $format = null)
    {
        $response = $this->query(['id' => $id, 'compress' => 'true'])
            ->get('/exchange/history/osrs/last90d')
            ->json();

        return $this->processGraph($response, $id, $format);
    }

    public function getSamplePricesGraph(string $id, string $format = null)
    {
        $response = $this->query(['id' => $id, 'compress' => 'true'])
            ->get('/exchange/history/osrs/sample')
            ->json();

        return $this->processGraph($response, $id, $format);
    }

    protected function processGraph(array $response, string $id, string $format = null)
    {
        return collect($response[$id])->map(function ($point) use ($format) {
            $volume = null;

            if (count($point) === 2) {
                [$timestamp, $price] = $point;
            } elseif (count($point) === 3) {
                [$timestamp, $price, $volume] = $point;
            }

            return [
                'timestamp' => $format
                    ? Carbon::createFromTimestamp($timestamp)->format($format)
                    : $timestamp,
                'price' => $price,
                'volume' => $volume,
            ];
        })->sortBy('timestamp')->values()->toArray();
    }
}
