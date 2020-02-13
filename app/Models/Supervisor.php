<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * App\Models\Supervisor
 *
 * @property int $id
 * @property string $username 用户名
 * @property string $password 密码
 * @property int $status 状态0禁用 1启用
 * @property string|null $name 姓名
 * @property string|null $identity 身份证号
 * @property string|null $cert_no 证书编号
 * @property int|null $role 身份1-考评员 2-督导员
 * @property string|null $contact 联系电话
 * @property string|null $expired_at 到期时间
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property int|null $exam_site_id 考试站ID 如果0则说明未分配
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AssessRecord[] $assessRecords
 * @property-read int|null $assess_records_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supervisor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supervisor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supervisor query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supervisor whereCertNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supervisor whereContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supervisor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supervisor whereExamSiteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supervisor whereExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supervisor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supervisor whereIdentity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supervisor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supervisor wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supervisor whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supervisor whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supervisor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Supervisor whereUsername($value)
 * @mixin \Eloquent
 */
class Supervisor extends AbstractAuthModel
{
    protected $table = 'supervisor';

    /** @var int 考评员 */
    const EVALUATE_STAFF = 1;

    /** @var int 督导员 */
    const MONITOR_STAFF = 2;


    /**
     * 一个考评员有多个考评记录
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assessRecords()
    {
        return $this->hasMany(AssessRecord::class, 'supervisor_id', 'id');
    }
}
