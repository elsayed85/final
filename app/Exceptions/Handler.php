<?php

namespace App\Exceptions;

use Error;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use MarcinOrlowski\ResponseBuilder\ExceptionHandlerHelper;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use Throwable;
use TypeError;

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
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Throwable
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */

    public function render($request, Throwable $e)
    {
        if ($request->is("api/*")) {
            $request->headers->set('Accept', 'application/json');
            if ($e instanceof TypeError || $e instanceof Error) {
                return ExceptionHandlerHelper::render($request, new Exception($e->getMessage(), $e->getCode(), $e->getPrevious()));
            } elseif($e instanceof AuthenticationException){
                return response()->json([
                    "success" => false,
                    'code' => 401,
                    'message' => $e->getMessage(),
                    "set_attributes" => [
                        'authenticated' => false
                    ]
                ] ,401);
            } else {
                return ExceptionHandlerHelper::render($request, $e);
            }
        }
        return parent::render($request, $e);
    }
}
