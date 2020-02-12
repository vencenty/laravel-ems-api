<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    public function getAnswerAttribute($value)
    {
        dd($value);
    }


}
