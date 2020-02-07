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
 * @property string|null $sn 学校编号
 * @property string|null $address 学校地址
 * @property string|null $contact_person 联系人
 * @property string|null $contact_mobile 联系电话
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamSite whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamSite whereContactMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamSite whereContactPerson($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamSite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamSite whereSn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamSite whereUpdatedAt($value)
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
