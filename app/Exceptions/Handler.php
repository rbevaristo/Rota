<?php

namespace App\Exceptions;

use Exception;
use Whoops\Exception\ErrorException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class Handler extends ExceptionHandler
{
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
        // if($exception instanceof HttpException || 
        // $exception instanceof ErrorException || 
        // $exception instanceof MethodNotAllowedHttpException ||
        // $exception instanceof ModelNotFoundException
        // ){
        //     return redirect()->route('not.found');
        // } else {
            //return redirect()->route('not.found');
            return parent::render($request, $exception);
        //}

    }

    /**
     * Convert an authentication exception into a response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if($request->expectsJson()){
            response()->json(['message' => $exception->getMessage()], 401);
        }
        
        $guard = array_get($exception->guards(), 0);

        switch($guard) {
            case 'admin':
                return redirect()->guest(route('admin.login'));
                break;
            case 'employee':
                return redirect()->guest(route('login'));
                break;
            default:
                return redirect()->guest(route('auth.admin'));
        }
    }
}
