<?php

namespace App\Http\Controllers;

use App\Components\ApiError;
use App\Http\Requests\UserLoginRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    protected $guard;

    /**
     * Create a new AuthController instance.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        // 根据角色选择门面类型
        $this->guard = $request->post('role');

        $this->middleware("jwt.role")->except(['login']);
    }

    /**
     * 获取验证
     * @param UserLoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(UserLoginRequest $request)
    {
        $credentials = $request->only(['username', 'password']);

        if (!$token = auth($this->guard)->attempt($credentials)) {
            return $this->error(ApiError::UNAUTHORIZED);
        }

        return $this->success(
            $this->respondWithToken($token)
        );
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return $this->success([
            'user' => auth()->user()
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return $this->success("退出成功");
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $token = auth()->refresh();
        return $this->success($this->respondWithToken($token));
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return array
     */
    protected function respondWithToken($token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }
}
