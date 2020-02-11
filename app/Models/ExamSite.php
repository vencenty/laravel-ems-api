<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;



/**
 * App\Models\ExamSite
 *
 * @property int $id
 * @property string|null $sn 考试站编号
 * @property string|null $username 用户名
 * @property string|null $password 密码
 * @property string|null $name 考试站名称
 * @property string|null $address 考试站地址
 * @property string|null $contact_person 考试站联系人
 * @property string|null $contact_mobile 考试站联系电话
 * @property string|null $desc 描述信息
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamSite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamSite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamSite query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamSite whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamSite whereContactMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamSite whereContactPerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamSite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamSite whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamSite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamSite whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamSite wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamSite whereSn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamSite whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamSite whereUsername($value)
 * @mixin \Eloquent
 */
class ExamSite extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'exam_site';

    protected $guarded = [];

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
