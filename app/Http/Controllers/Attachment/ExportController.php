<?php

namespace App\Http\Controllers\Attachment;

use App\Components\Helper\Excels;
use App\Exports\QuestionExport;
use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Writer\Exception;

class ExportController extends Controller
{
    public function question(Request $request)
    {

        return (new QuestionExport)
            ->bySubjectId($request->get('subject_id'))
            ->download('invoices.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }
}
