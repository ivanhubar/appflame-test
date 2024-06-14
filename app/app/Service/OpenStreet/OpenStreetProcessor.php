<?php

namespace App\Service\OpenStreet;

use Illuminate\Support\Facades\Http;

class OpenStreetProcessor
{
    /**
     * @return array
     */
    public static function getData(): array
    {
        $response = Http::get("https://nominatim.openstreetmap.org/search", [
            "q" => "область+Украина",
            "limit" => 1000,
            "format" => "jsonv2",
            "polygon_geojson" => 1,
            "accept-language" => "en",
        ]);

        return $response->json();
    }
}
