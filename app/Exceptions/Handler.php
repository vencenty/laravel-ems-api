<?php

namespace App\Exceptions;

use App\Components\ApiError;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Vencenty\LaravelEnhance\Traits\JsonResponse;

class Handler extends ExceptionHandler
{
    use JsonResponse;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param \Exception $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }

    /**
     * 重写返回客户端的Json响应
     *
     * @param Exception $e
     * @return array
     */
    protected function convertExceptionToArray(Exception $e)
    {
        $error = 500;

        return config('app.debug') ? [
            'error' => $error,
            'message' => $e->getMessage(),
            'exception' => get_class($e),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => collect($e->getTrace())->map(function ($trace) {
                return \Arr::except($trace, ['args']);
            })->all(),
        ] : [
            'error' => $error,
            'message' => $this->isHttpException($e) ? $e->getMessage() : 'Server Error',
        ];
    }


    /**
     * 重写表单验证失败返回的接口形式
     *
     * @param \Illuminate\Http\Request $request
     * @param ValidationException $exception
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function invalidJson($request, ValidationException $exception)
    {
        $errorMessage = [];
        foreach ($exception->errors() as $key => $errors) {
            foreach ($errors as $error) {
                array_push($errorMessage, $error);
            }
        }
        return $this->error([
            'message' => $errorMessage,
        ], $exception->status);
    }

}
