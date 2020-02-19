<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Skill
 *
 * @property int $id
 * @property string|null $name 技能名称
 * @property string|null $level
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subject query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subject whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subject whereName($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SubjectLevel[] $levels
 * @property-read int|null $levels_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Supervisor[] $supervisors
 * @property-read int|null $supervisors_count
 */
class Subject extends AbstractModel
{

    /**
     * 表名
     *
     * @var string
     */
    protected $table = 'subject';

    /**
     * 默认隐藏字段
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

}
