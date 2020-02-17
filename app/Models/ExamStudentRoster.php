<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamStudentRoster extends AbstractModel
{
    protected $table = 'exam_student_roster';

    /**
     * 学生属于考试计划里面的
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function examPlan()
    {
        return $this->belongsTo(ExamPlan::class, 'exam_id', 'id');
    }
}
