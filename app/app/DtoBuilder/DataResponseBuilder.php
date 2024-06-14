<?php

namespace App\DtoBuilder;

use App\Dto\Data\DataCacheResponseDto;
use App\Dto\Data\DataGeoResponseDto;
use App\Dto\Data\DataResponseDto;
use App\Enum\CacheHitEnum;

class DataResponseBuilder
{
    private DataResponseDto $dataResponseDto;

    public function __construct()
    {
        $this->dataResponseDto = new DataResponseDto();
        $this->dataResponseDto->cache = new DataCacheResponseDto();
        $this->dataResponseDto->geo = new DataGeoResponseDto();
    }

    public function build(): DataResponseDto
    {
        return $this->dataResponseDto;
    }

    public function hit(): static
    {
        $this->dataResponseDto->cache->cache = CacheHitEnum::HIT;

        return $this;
    }

    public function miss(): static
    {
        $this->dataResponseDto->cache->cache = CacheHitEnum::MISS;

        return $this;
    }

    public function oblast(?string $oblast): static
    {
        $this->dataResponseDto->geo->oblast = $oblast;

        return $this;
    }
}
