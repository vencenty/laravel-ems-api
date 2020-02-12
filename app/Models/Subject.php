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
 */
class Subject extends AbstractModel
{

    protected $table = 'subject';
}
