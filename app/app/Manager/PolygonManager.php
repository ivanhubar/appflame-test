<?php

namespace App\Manager;

use App\Models\Polygon;
use Illuminate\Support\Facades\DB;

class PolygonManager
{
    public function purge(): void
    {
        Polygon::truncate();
    }

    public function findOblastByLonAndLat(float $lon, float $lat): ?string
    {
        $polygon = Polygon::query()
            ->select('oblast')
            ->whereRaw(
                'ST_Contains(ST_SetSRID(geom, 4326), ST_SetSRID(ST_MakePoint(?, ?), 4326))',
                [$lon, $lat]
            )
            ->first();

        return $polygon?->oblast ?? null;
    }
}
