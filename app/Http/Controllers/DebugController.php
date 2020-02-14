<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Student;
use App\Models\Subject;
use App\Models\SubjectLevel;
use App\Models\Supervisor;
use Barryvdh\DomPDF\PDF;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class DebugController extends Controller
{
    public function index()
    {
        $supervisor = Supervisor::find(1);
        foreach($supervisor->subjects as $subject) {
            dump( SubjectLevel::find($subject->pivot->subject_level_id)->name);
        }

    }

    private function getView()
    {
        sleep(2);
        $view = file_get_contents('https://jd.com');

        return view('template', compact('view'))->__toString();

    }

    public function iterate()
    {
    }
}
