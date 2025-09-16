<?php
namespace App\Services;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class TodoExportService
{
    public function exportToExcel($todosCollection)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $headers = ['Title','Assignee','Due Date','Time Tracked','Status','Priority'];
        $col = 'A';
        foreach ($headers as $h) {
            $sheet->setCellValue($col.'1', $h);
            $col++;
        }

        // Body
        $row = 2;
        foreach ($todosCollection as $t) {
            $sheet->setCellValue('A'.$row, $t->title);
            $sheet->setCellValue('B'.$row, $t->assignee);
            $sheet->setCellValue('C'.$row, $t->due_date?->toDateString());
            $sheet->setCellValue('D'.$row, $t->time_tracked);
            $sheet->setCellValue('E'.$row, $t->status);
            $sheet->setCellValue('F'.$row, $t->priority);
            $row++;
        }

        // Summary row (leave one empty row)
        $sheet->setCellValue('A'.$row, '');
        $row++;
        $sheet->setCellValue('A'.$row, 'Total Todos');
        $sheet->setCellValue('B'.$row, $todosCollection->count());
        $row++;
        $sheet->setCellValue('A'.$row, 'Total Time Tracked');
        $sheet->setCellValue('B'.$row, $todosCollection->sum('time_tracked'));

        // Save to temporary file
        $fileName = 'todos_export_'.now()->format('Ymd_His').'.xlsx';
        $filePath = storage_path('app/exports/'.$fileName);
        if (!file_exists(dirname($filePath))) mkdir(dirname($filePath), 0755, true);

        $writer = new Xlsx($spreadsheet);
        $writer->save($filePath);

        return $filePath;
    }
}
