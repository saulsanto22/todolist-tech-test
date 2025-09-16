<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Helpers\ApiResponse;
use App\Services\TodoFilterService;
use App\Services\TodoExportService;
use Illuminate\Http\Request;
use App\Exports\TodoExport;
use Maatwebsite\Excel\Facades\Excel;

class TodoExportController extends Controller
{
      public function export(Request $request)
    {


       $fileName = 'todos_export_' . now()->format('Ymd_His') . '.xlsx';
    return Excel::download(new TodoExport($request), $fileName);
    }
}
