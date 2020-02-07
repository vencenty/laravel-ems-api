<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * App\Models\Admin
 *
 * @property int $id
 * @property string|null $name 真实姓名
 * @property string|null $username 身份证号码
 * @property string|null $password 密码
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamSiteAdmin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamSiteAdmin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamSiteAdmin query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamSiteAdmin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamSiteAdmin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamSiteAdmin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamSiteAdmin whereUsername($value)
 * @mixin \Eloquent
 */
class ExamCenterAdmin extends Authenticatable implements JWTSubject
{
    use Notifiable;


    protected $table = 'exam_center_admin';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }


}
