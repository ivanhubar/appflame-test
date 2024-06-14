<?php

namespace App\Dto\Jobs;

use Illuminate\Contracts\Support\Arrayable;

class JobItemResponseDto implements Arrayable
{
    public int $createdTs;

    public int $scheduledForTs;

    public int $state;

    public function toArray(): array
    {
        return [
            "createdTs" => $this->createdTs,
            "scheduledForTs" => $this->scheduledForTs,
            "state" => $this->state,
        ];
    }
}
