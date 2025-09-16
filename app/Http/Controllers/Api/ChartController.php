<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ChartService;
use App\Helpers\ApiResponse;

class ChartController extends Controller
{
    public function index(Request $request, ChartService $chartService)
    {
        $type = $request->query('type');
        try {
            $data = $chartService->getChartData($type);
            return ApiResponse::success($data);
        } catch (\InvalidArgumentException $e) {
            return ApiResponse::error($e->getMessage(), 400);
        }
    }
}
