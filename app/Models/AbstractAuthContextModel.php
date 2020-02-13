<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * App\Models\AbstractAuthContextModel
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AbstractAuthContextModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AbstractAuthContextModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AbstractAuthContextModel query()
 * @mixin \Eloquent
 */
class AbstractAuthContextModel extends Authenticatable {}
