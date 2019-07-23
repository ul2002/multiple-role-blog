<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class Handler extends ExceptionHandler
{
   
    const HTTP_FORBIDDEN  = 403;
    const HTTP_ERROR  = 500;
    const HTTP_VALIDATION  = 422;

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
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof UnauthorizedHttpException) {
            $preException = $exception->getPrevious();
            if ($preException instanceof
                          \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['error' => 'TOKEN_EXPIRED'], self::HTTP_FORBIDDEN);
            } else if ($preException instanceof
                          \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['error' => 'TOKEN_INVALID'], self::HTTP_FORBIDDEN);
            } else if ($preException instanceof
                     \Tymon\JWTAuth\Exceptions\TokenBlacklistedException) {
                 return response()->json(['error' => 'TOKEN_BLACKLISTED'], self::HTTP_FORBIDDEN);
           }
           if ($exception->getMessage() === 'Token not provided') {
               return response()->json(['error' => 'Token not provided'], self::HTTP_FORBIDDEN);
           }
           if ($exception instanceof \Illuminate\Validation\ValidationException) { 
            return new JsonResponse($exception->errors(), self::HTTP_VALIDATION); 
           }

        }

        if ($exception instanceof AuthorizationException) {
            return response()->json(['error' => 'This action is unauthorized'], self::HTTP_FORBIDDEN);
        }
        if ($exception instanceof
                \Tymon\JWTAuth\Exceptions\JWTException) {
            return response()->json(['error' => 'An error occurred on jwt process'], self::HTTP_ERROR);
        }

        

        return parent::render($request, $exception);
    }
}
