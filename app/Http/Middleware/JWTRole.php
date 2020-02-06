<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Payload;
use Vencenty\LaravelEnhance\Traits\JsonResponse;

class JWTRole
{
    use JsonResponse;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


        $this->authenticate($request);
        return $next($request);
    }

    /**
     * 根据jwt类型切换用户
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    protected function authenticate(Request $request)
    {
        /** @var Payload $payload */
        $payload = auth()->getPayload();

        if(!$payload) {
            return $this->error("can not load payload");
        }

        $hashModel = $payload->get('prv');

        $guard = null;
        // 切换验证Model
        switch ($hashModel) {
            case sha1(User::class):
                $guard = 'user';
                break;
            case sha1(Admin::class):
                $guard = 'admin';
                break;
            default:
                break;
        }

        auth()->shouldUse($guard);


    }
}
