<?php

namespace App\Http\Controllers;

use App\Components\ApiError;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UserLoginRequest;
use App\Models\ExamSiteAdmin;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * 登录用户的角色
     *
     * @var array|string|null
     */
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
     *
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
     * 用户退出登录,Token也会失效
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();
        return $this->success("退出成功");
    }

    /**
     * 刷新Token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        $token = auth()->refresh();
        return $this->success($this->respondWithToken($token));
    }

    /**
     * 获取令牌数组结构
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

    /**
     * 重置密码
     *
     * @param ResetPasswordRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        /** @var Student $user */
        $user = auth()->user();

        // 原始密码
        $originPassword = $request->post('origin_password');
        // 新密码
        $password = $request->post('password');
        // 检查密码是否正确
        if(!Hash::check($originPassword, $user->password)) {
            return $this->error(ApiError::USER_PASSWORD_ERROR);
        }

        $user->password = bcrypt($password);
        $user->save();

        return $this->success();
    }
}
