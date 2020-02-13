<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * App\Models\AbstractAuthModel
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AbstractAuthModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AbstractAuthModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AbstractAuthModel query()
 * @mixin \Eloquent
 */
class AbstractAuthModel extends AbstractModel implements JWTSubject
{
    use Notifiable;

    /**
     * 不予显示的字段
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * 返回JWT subjectId
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * 加入自定义JWT Claims
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


}
