<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ExamPlan
 *
 * @property int $id
 * @property int|null $in_plan 是否在年度计划内
 * @property int|null $num 人数
 * @property int|null $status 0 未开始
 * 1 开始
 * -1 未结束
 * @property int|null $skill_id 考试技能ID
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamPlan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamPlan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamPlan query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamPlan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamPlan whereInPlan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamPlan whereNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamPlan whereSkillId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamPlan whereStatus($value)
 * @mixin \Eloquent
 */
class ExamPlan extends AbstractModel
{
    protected $table = 'exam_plan';

    /**
     * 考试等待审批状态
     *
     * @var int
     */
    const APPROVING = 0;

    /**
     * 考试审批通过
     *
     * @var int
     */
    const APPROVAL_PASS = 1;

    /**
     * 考试审批拒绝
     *
     * @var int
     */
    const APPROVAL_REJECT = -1;

    /**
     * 以后多个技能考试安排
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function skillExamArranges()
    {
        return $this->hasMany(SkillExamArrange::class, 'exam_plan_id', 'id');
    }

    /**
     * 有多个理论考试安排
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function theoryExamArranges()
    {
        return $this->hasMany(TheoryExamArrange::class, 'exam_plan_id', 'id');
    }
}
