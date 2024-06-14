<?php

namespace App\Jobs;

use App\Enum\CacheEnum;
use App\Models\Polygon;
use App\Service\OpenStreet\OpenStreetProcessor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DownloadPolygons implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public readonly string $jobId,
    )
    {
    }

    public function handle(): void
    {
        $data = OpenStreetProcessor::getData();

        DB::transaction(function () use ($data) {
            foreach ($data as $polygon) {
                $geojson = json_encode($polygon['geojson']);
                Polygon::updateOrCreate(
                    ["oblast" => $polygon['name'], "geom" => DB::raw("ST_GeomFromGeoJSON('{$geojson}')")],
                );
            }
        });

        $jobData = Cache::get(CacheEnum::JOB_PREFIX->value . $this->jobId);
        $jobData["state"] = 2;
        Cache::forever(CacheEnum::JOB_PREFIX->value . $this->jobId, $jobData);
    }
}
