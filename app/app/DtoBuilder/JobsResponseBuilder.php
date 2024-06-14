<?php

namespace App\DtoBuilder;

use App\Dto\Jobs\JobItemResponseDto;
use App\Dto\Jobs\JobsResponseDto;

class JobsResponseBuilder
{
    public static function build(array $items): JobsResponseDto
    {
        $jobsResponseDto = new JobsResponseDto();

        foreach ($items as $item) {
            $jobItemResponseDto = new JobItemResponseDto();
            $jobItemResponseDto->state = $item["state"];
            $jobItemResponseDto->createdTs = $item["createdTs"];
            $jobItemResponseDto->scheduledForTs = $item["scheduledForTs"];
            $jobsResponseDto->data[] = $jobItemResponseDto;
        }

        return $jobsResponseDto;
    }
}
