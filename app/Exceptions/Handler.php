<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
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
        $identity = get_class($exception);


        // 开启调试模式
        if (env('APP_DEBUG')) {
            switch ($identity) {
                case ValidationException::class:
                    $result = $this->convertValidationExceptionToResponse($exception, $request);
                    break;
//                case MethodNotAllowedHttpException::class:
//                    $result = ['message' => $exception->getMessage()];
//                    break;
                default:
                    $result = $exception->getMessage();
                    break;
            }
            return $this->error($result);
        }
        return parent::render($request, $exception);
    }


    /**
     * 重写表单验证方法
     *
     * @param ValidationException|Exception $e
     * @param \Illuminate\Http\Request $request
     * @return array|\Symfony\Component\HttpFoundation\Response
     */
    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        $errorMessage = [];
        foreach ($e->errors() as $key => $errors) {
            foreach ($errors as $error) {
                array_push($errorMessage, $error);
            }
        }

        return ['message' => $errorMessage];
    }





}
