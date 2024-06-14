<?php

namespace App\Dto\Data;

use App\Enum\CacheHitEnum;
use Illuminate\Contracts\Support\Arrayable;

class DataCacheResponseDto implements Arrayable
{
    public CacheHitEnum $cache;

    public function toArray(): array
    {
        return ["cache" => $this->cache->value];
    }
}
