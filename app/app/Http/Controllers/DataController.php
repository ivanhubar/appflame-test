<?php

namespace App\Http\Controllers;

use App\Service\Data\DataProcessor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function __construct(
        private readonly DataProcessor $dataProcessor,
    )
    {
    }

    public function put(Request $request): JsonResponse
    {
        return response()->json($this->dataProcessor->put($request)->toArray());
    }

    public function get(Request $request): JsonResponse
    {
        return response()->json($this->dataProcessor->get($request)->toArray());
    }

    public function purge(): JsonResponse
    {
        return response()->json($this->dataProcessor->purge()->toArray());
    }
}
