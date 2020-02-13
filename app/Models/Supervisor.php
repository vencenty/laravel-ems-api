<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Supervisor extends Authenticatable implements JWTSubject
{
    protected $table = 'supervisor';

    /** @var int 考评员 */
    const EVALUATE_STAFF = 1;

    /** @var int 督导员 */
    const SUPERVISOR = 0;

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }


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
