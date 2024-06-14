<?php

namespace App\Enum;

enum CacheHitEnum: string
{
    case HIT = "hit";
    case MISS = "miss";
}
