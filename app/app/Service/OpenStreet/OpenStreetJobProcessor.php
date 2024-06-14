<?php

namespace App\Service\OpenStreet;

use App\Dto\Concern\SuccessResponse;
use App\Dto\Jobs\JobsResponseDto;
use App\DtoBuilder\JobsResponseBuilder;
use App\DtoBuilder\ResponseBuilder;
use App\Enum\CacheEnum;
use App\Manager\CacheManager;
use Illuminate\Http\Request;

class OpenStreetJobProcessor
{
    public function __construct(
        private readonly CacheManager $cacheManager,
    )
    {
    }

    public function register(int $secondsDelay): string
    {
        $jobId = uniqid();

        $jobsIds = $this->cacheManager->get(CacheEnum::JOBS->value, []);

        $jobsIds[] = $jobId;

        $this->cacheManager->forever(CacheEnum::JOBS->value, $jobsIds);

        $jobData = [
            "createdTs" => now()->timestamp,
            "scheduledForTs" => now()->addSeconds($secondsDelay)->timestamp,
            "state" => 0,
        ];

        $this->cacheManager->forever(CacheEnum::JOB_PREFIX->value . $jobId, $jobData);

        return $jobId;
    }

    public function get(Request $request): SuccessResponse|JobsResponseDto
    {
        if ($request->query->getString("action") !== "list") {
            return ResponseBuilder::failedResponse();
        }

        $limit = $request->query->getInt("limit", 1);

        $jobsIds = $this->cacheManager->get(CacheEnum::JOBS->value, []);

        if (empty($jobsIds)) {
            return JobsResponseBuilder::build([]);
        }

        $jobsIds = array_slice($jobsIds, -$limit);
        $jobsIds = array_reverse($jobsIds);

        $jobs = array_map(fn($jobId) => $this->cacheManager->get(CacheEnum::JOB_PREFIX->value . $jobId), $jobsIds);

        return JobsResponseBuilder::build($jobs);

    }
}
