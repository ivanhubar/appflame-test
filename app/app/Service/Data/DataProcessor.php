<?php

namespace App\Service\Data;

use App\Dto\Concern\SuccessResponse;
use App\Dto\Data\DataResponseDto;
use App\DtoBuilder\DataResponseBuilder;
use App\DtoBuilder\ResponseBuilder;
use App\Jobs\DownloadPolygons;
use App\Manager\CacheManager;
use App\Manager\PolygonManager;
use App\Service\OpenStreet\OpenStreetJobProcessor;
use Illuminate\Http\Request;

class DataProcessor
{
    public function __construct(
        private readonly DataResponseBuilder    $dataResponseBuilder,
        private readonly OpenStreetJobProcessor $openStreetJobProcessor,
        private readonly PolygonManager         $polygonManager,
        private readonly CacheManager           $cacheManager,
    )
    {
    }

    public function put(Request $request): SuccessResponse
    {
        if ($request->query->getString("action") !== "refresh") {
            return ResponseBuilder::failedResponse();
        }

        $delay = $request->query->getInt("delaySeconds");
        $jobId = $this->openStreetJobProcessor->register($delay);

        DownloadPolygons::dispatch($jobId)->delay($delay);

        return ResponseBuilder::successResponse();
    }

    public function get(Request $request): DataResponseDto
    {
        $lat = (float)$request->query->get("lat");
        $lon = (float)$request->query->get("lon");
        $cacheKey = "geo:$lat:$lon";

        $oblast = $this->cacheManager->get($cacheKey);

        if (!$oblast) {
            $oblast = $this->polygonManager->findOblastByLonAndLat($lon, $lat);

            $this->cacheManager->forever($cacheKey, $oblast);

            return $this->dataResponseBuilder->miss()->oblast($oblast)->build();
        }

        return $this->dataResponseBuilder->hit()->oblast($oblast)->build();
    }

    public function purge(): SuccessResponse
    {
        $this->polygonManager->purge();
        $this->cacheManager->clear();

        return ResponseBuilder::successResponse();
    }
}
