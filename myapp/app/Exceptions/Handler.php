<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use App\Exceptions\VerificationCodeAlreadySentException;
use App\Exceptions\InvalidEmailCodeException;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler

{
   public function render($request, Throwable $exception){
      if ($exception instanceof VerificationCodeAlreadySentException){
    return response()->json(['statys'=>'error', 'error'=>$exception->getMessage()], 473, [], JSON_UNESCAPED_UNICODE);
}
     if ($exception instanceof InvalidEmailCodeException){
       return response()->json(['statys'=>'error', 'error'=>$exception->getMessage()], 453, [], JSON_UNESCAPED_UNICODE);
    }
     return response()->json(['statys'=>'error', 'error'=>$exception->getMessage()],500, [], JSON_UNESCAPED_UNICODE);
    }

/*
public function render($request, Throwable $exception)
{
    if ($request->expectsJson()) {
        return parent::render($request, $exception);
    }

    // Убираем редирект вообще
    if ($exception instanceof ValidationException) {
        return response()->json([
            'message' => 'Validation error',
            'errors' => $exception->errors()
        ], 422);
    }

    return parent::render($request, $exception);
}
*/
/*
public function render($request, Throwable $exception)
{
    if ($request->expectsJson()) {
        return parent::render($request, $exception);
    }

    // Принудительно всегда JSON, если вдруг не указан Accept
    if ($request->is('api/*')) {
        return response()->json([
            'message' => $exception->getMessage(),
        ], method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500);
    }

    return parent::render($request, $exception);
}
   */


/*public function render($request, Throwable $exception)
{
    if ($request->expectsJson() || $request->is('api/*')) {
        $status = 500; // По умолчанию

        if ($exception instanceof HttpExceptionInterface) {
            $status = $exception->getStatusCode();
        }

        return response()->json([
            'message' => $exception->getMessage(),
        ], $status);
    }

    return parent::render($request, $exception);
}
*/



 public function invalidJson($request, ValidationException $exception)
{
    return response()->json([
        'message' => 'Validation failed',
        'errors' => $exception->errors(),
    ], $exception->status);
}
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
