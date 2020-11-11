<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use MarcinOrlowski\ResponseBuilder\ExceptionHandlerHelper;
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
        if ($request->acceptsJson() && $request->wantsJson()) {
            if ($e instanceof TypeError) {
                return response()->json([
                    'success' =>  false,
                    'message' => $e->getMessage(),
                    'locale' => app()->getLocale(),
                    'code' => 500,
                    'data' =>  null
                ], 500);
            } else {
                return ExceptionHandlerHelper::render($request, $e);
            }
        }
        return parent::render($request, $e);
    }
}
