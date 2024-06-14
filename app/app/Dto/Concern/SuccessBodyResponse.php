<?php

namespace App\Dto\Concern;

use Illuminate\Contracts\Support\Arrayable;

readonly class SuccessBodyResponse implements Arrayable
{
    public function __construct(
        public bool $success,
    )
    {
    }

    public function toArray(): array
    {
        return ["success" => $this->success];
    }
}
