<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Subject;
use Barryvdh\DomPDF\PDF;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class DebugController extends Controller
{
    public function index()
    {
//        dd(storage_path('material'));
//        echo asset('storage/material/职业技能鉴定质量督导表.docx');
//        die;
        return Storage::disk('material')->download('职业技能鉴定质量督导表.docx','职业技能鉴定质量督导表.docx');

    }

    public function iterate()
    {
        yield Question::all();
    }
}
