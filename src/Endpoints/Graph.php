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
        $response = $this->query([
            'compress' => true,
            'id' => $id,
        ])->get('/exchange/history/osrs/all')->json();

        return collect($response[$id])
            ->when($format, function ($collection, $format) {
                return $collection->map(function ($point) use ($format) {
                    return array_merge($point, [
                        'timestamp' => Carbon::createFromTimestamp($point['timestamp'])->format($format),
                    ]);
                });
            })
            ->map(function ($point) {
                unset($point['id']);

                return $point;
            })
            ->sortBy('timestamp')
            ->toArray();
    }
}
