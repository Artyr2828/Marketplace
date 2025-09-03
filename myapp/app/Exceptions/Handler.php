<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use App\Exceptions\VerificationCodeAlreadySentException;
use App\Exceptions\InvalidEmailCodeException;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
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


 /* public function render($request, Throwable $exception)
{
    // Логируем все ошибки
    \Log::error($exception);

    // Пользовательские исключения
    if ($exception instanceof VerificationCodeAlreadySentException) {
        return response()->json([
            'status' => 'error',
            'message' => 'Код уже был отправлен'
        ], 400, [], JSON_UNESCAPED_UNICODE);
    }

    if ($exception instanceof InvalidEmailCodeException) {
        return response()->json([
            'status' => 'error',
            'message' => 'Неверный код'
        ], 400, [], JSON_UNESCAPED_UNICODE);
    }

    // Все остальные ошибки — нейтральное сообщение для пользователя
    return response()->json([
        'status' => 'error',
        'message' => 'Произошла ошибка, попробуйте позже'
    ], 500, [], JSON_UNESCAPED_UNICODE);
}
*/
  protected function unauthenticated($request, AuthenticationException $e){
     if ($request->expectsJson()){
       return response()->api(["status"=>"AuthorizationUser"]);
    } else{
        return response()->api(["status"=>"Error"]);
     }
  }


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
