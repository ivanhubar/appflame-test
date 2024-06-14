<?php

namespace App\Dto\Concern;

use Illuminate\Contracts\Support\Arrayable;

readonly class SuccessResponse implements Arrayable
{
    public function __construct(
        public Arrayable $data,
    )
    {
    }

    public function toArray(): array
    {
        return ["data" => $this->data->toArray()];
    }
}
