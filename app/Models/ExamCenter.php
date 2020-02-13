<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;



/**
 * App\Models\ExamCenter
 *
 * @property int $id
 * @property string|null $username 用户名
 * @property string|null $password 密码
 * @property string|null $identity 身份证号
 * @property int|null $status 状态0无效 1有效
 * @property string|null $expire_time 到期时间
 * @property string|null $contact 联系电话
 * @property string|null $cert_sn 证书编号
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamCenter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamCenter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamCenter query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamCenter whereCertSn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamCenter whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamCenter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamCenter whereExpireTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamCenter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamCenter whereIdentity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamCenter wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamCenter whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamCenter whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ExamCenter whereUsername($value)
 * @mixin \Eloquent
 */
class ExamCenter extends AbstractAuthModel
{

    protected $table = 'exam_center';


}
