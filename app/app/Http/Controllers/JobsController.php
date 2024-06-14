<?php

namespace App\Http\Controllers;

use App\Service\OpenStreet\OpenStreetJobProcessor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    public function __construct(
        private readonly OpenStreetJobProcessor $openStreetJobProcessor,
    )
    {
    }

    public function get(Request $request): JsonResponse
    {
        return response()->json($this->openStreetJobProcessor->get($request)->toArray());
    }
}
