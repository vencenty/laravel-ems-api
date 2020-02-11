<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\TrainingPlan
 *
 * @property int $id
 * @property int|null $skill_id
 * @property int $expect_num 预计培训人数
 * @property int $actual_num 实际培训人数
 * @property string $theory_training_start_time 理论培训预计开始时间
 * @property string $theory_training_end_time 理论培训预计结束时间
 * @property string $skill_training_start_time 技能培训预计开始时间
 * @property string $skill_training_end_time 技能培训预计结束时间
 * @property string $theory_exam_start_time 理论考试开始时间
 * @property string $theory_exam_end_time 理论考试结束时间
 * @property string $skill_exam_start_time 技能考试开始时间
 * @property string $skill_exam_end_time 技能考试结束时间
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $half 0上半年 1下半年
 * @property string $year 年度
 * @property int $exam_site_id 考试站ID
 * @property string|null $deleted_at 删除时间
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrainingPlan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrainingPlan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrainingPlan query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrainingPlan whereActualNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrainingPlan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrainingPlan whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrainingPlan whereExamSiteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrainingPlan whereExpectNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrainingPlan whereHalf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrainingPlan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrainingPlan whereSkillExamEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrainingPlan whereSkillExamStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrainingPlan whereSkillId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrainingPlan whereSkillTrainingEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrainingPlan whereSkillTrainingStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrainingPlan whereTheoryExamEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrainingPlan whereTheoryExamStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrainingPlan whereTheoryTrainingEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrainingPlan whereTheoryTrainingStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrainingPlan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TrainingPlan whereYear($value)
 * @mixin \Eloquent
 */
class TrainingPlan extends AbstractModel
{

    protected $table = 'training_plan';

    /**
     * 不允许填充的字段
     * @var array
     */
    protected $guarded = [
        'actual_num'
    ];

}
