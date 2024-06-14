<?php

namespace App\Dto\Jobs;

use Illuminate\Contracts\Support\Arrayable;

class JobsResponseDto implements Arrayable
{
    /**
     * @var JobItemResponseDto[]
     */
    public array $data = [];

    public function toArray(): array
    {
        $data = [];

        foreach ($this->data as $item) {
            $data[] = $item->toArray();
        }

        return ["data" => $data];
    }
}
