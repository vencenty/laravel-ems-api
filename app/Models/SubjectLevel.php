<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SubjectLevel
 *
 * @property int $id
 * @property string|null $name 等级名称
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SubjectLevel[] $levels
 * @property-read int|null $levels_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubjectLevel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubjectLevel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubjectLevel query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubjectLevel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubjectLevel whereName($value)
 * @mixin \Eloquent
 */
class SubjectLevel extends AbstractModel
{
    protected $table = 'subject_level';

    public $timestamps = false;

    /**
     * 属于ID
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function levels()
    {
        return $this->belongsToMany(SubjectLevel::class, 'subject_level_map', 'subject_level_id', 'subject_id');
    }
}
