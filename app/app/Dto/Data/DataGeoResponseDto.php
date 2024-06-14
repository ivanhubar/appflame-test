<?php

namespace App\Dto\Data;

use Illuminate\Contracts\Support\Arrayable;

class DataGeoResponseDto implements Arrayable
{
    public ?string $oblast;

    public function toArray(): array
    {
        return ["oblast" => $this->oblast];
    }
}
