<?php

namespace App\Manager;

use Illuminate\Support\Facades\Cache;

class CacheManager
{
    public function clear(): void
    {
        Cache::clear();
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return Cache::get($key, $default);
    }

    public function forever(string $key, mixed $data): void
    {
        Cache::forever($key, $data);
    }
}
