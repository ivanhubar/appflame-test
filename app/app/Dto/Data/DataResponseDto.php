<?php

namespace App\Dto\Data;

use Illuminate\Contracts\Support\Arrayable;

class DataResponseDto implements Arrayable
{
    public DataGeoResponseDto $geo;

    public DataCacheResponseDto $cache;

    public function toArray(): array
    {
        return ["geo" => $this->geo->toArray(), "cache" => $this->cache->cache->value];
    }
}
