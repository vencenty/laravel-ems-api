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

    protected $table = 'subject';

    public function levels()
    {
        return $this->belongsToMany(SubjectLevel::class, 'subject_level_map', 'subject_id', 'subject_level_id');
    }

    public function supervisors()
    {
        return $this->belongsToMany(Supervisor::class, 'supervisor_subject_map', 'subject_id', 'supervisor_id')
            ->withPivot(['subject_level_id']);
    }

}
