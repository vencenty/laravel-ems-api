<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Question
 *
 * @property int $id
 * @property string|null $title 题目
 * @property string|null $answer 答案
 * @property int|null $level 难易程度
 * @property array|null $options 选项
 * @property int|null $subject_id 所属学科
 * @property string|null $type 1单选 2 判断 3多选
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 修改时间
 * @property \Illuminate\Support\Carbon|null $deleted_at 删除时间
 * @property string|null $reference_answer 参考答案
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Question onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereReferenceAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Question whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Question withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Question withoutTrashed()
 * @mixin \Eloquent
 */
class Question extends AbstractModel
{
    use SoftDeletes;

    /** @var int 单选 */
    const SINGLE_CHOICE = 1;

    /** @var int 判断题 */
    const JUDGE = 2;

    /** @var int 多选 */
    const MULTIPLE_CHOICE = 3;

    protected $table = 'question';


    protected $casts = [
        'options' => 'json',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * 一对一关联试题科目
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    /**
     * 检查数据库是否有类似题目
     *
     * @param $newTitle
     * @return \Illuminate\Http\JsonResponse
     */
    public static function hasSimilar($newTitle)
    {
        $model = (new self);
        foreach ($model->title as $title) {
            similar_text($newTitle, $title, $percent);
            if ($percent > 90) {
                return $model->error('已经有类似题目了,请确认后添加');
            }
        }
    }

}
