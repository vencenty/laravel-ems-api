<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AssessRecord
 *
 * @property int $id
 * @property int|null $supervisor_id
 * @property int|null $exam_id 考试ID
 * @property string|null $report 考评报告
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AssessRecord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AssessRecord newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AssessRecord query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AssessRecord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AssessRecord whereExamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AssessRecord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AssessRecord whereReport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AssessRecord whereSupervisorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AssessRecord whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AssessRecord extends Model
{
    protected $table = 'assess_record';
}
