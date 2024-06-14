<?php

namespace App\DtoBuilder;

use App\Dto\Concern\SuccessBodyResponse;
use App\Dto\Concern\SuccessResponse;

class ResponseBuilder
{
    public static function successResponse(): SuccessResponse
    {
        return new SuccessResponse(new SuccessBodyResponse(true));
    }

    public static function failedResponse(): SuccessResponse
    {
        return new SuccessResponse(new SuccessBodyResponse(false));
    }
}
