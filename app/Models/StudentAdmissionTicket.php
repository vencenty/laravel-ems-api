<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\StudentAdmissionTicket
 *
 * @property int $id
 * @property int|null $take_theory_exam 理论考试是否参考 0 不参加 1 参加
 * @property string|null $name 考生名称
 * @property string|null $contact 联系方式
 * @property string|null $skill_name 职业技能名称
 * @property string|null $skill_level 职业技能等级
 * @property string|null $theory_exam_start_time 理论考试开始时间
 * @property string|null $theory_exam_end_time 理论考试结束时间
 * @property string|null $exam_room 考场
 * @property string|null $status 准考证当前状态
 * 0开启使用
 * 1使用中
 * -1已经失效
 * @property string|null $sn 准考证号
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentAdmissionTicket newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentAdmissionTicket newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentAdmissionTicket query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentAdmissionTicket whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentAdmissionTicket whereExamRoom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentAdmissionTicket whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentAdmissionTicket whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentAdmissionTicket whereSkillLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentAdmissionTicket whereSkillName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentAdmissionTicket whereSn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentAdmissionTicket whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentAdmissionTicket whereTakeTheoryExam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentAdmissionTicket whereTheoryExamEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\StudentAdmissionTicket whereTheoryExamStartTime($value)
 * @mixin \Eloquent
 */
class StudentAdmissionTicket extends AbstractModel
{
    protected $table = 'student_admission_ticket';
}
