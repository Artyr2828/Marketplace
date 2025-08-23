<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;
use App\Interfaces\VerificationCodeInterface;
use App\Services\Storage\VerificationCodeStorage;
use App\Services\Storage\PendingUserStorage;
use App\Interfaces\PendingUserStorageInterface;
use App\Interfaces\ValidationCodeInterface;
use App\Services\Email\ValidationClientCode;
use App\Interfaces\UserRegistrationInterface;
use App\Services\User\UserRegistrationService;
use App\Interfaces\AuthenticationServiceInterface;
use App\Services\Auth\AuthenticationService;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(VerificationCodeInterface::class, VerificationCodeStorage::class);
        $this->app->bind(PendingUserStorageInterface::class, PendingUserStorage::class);
        $this->app->bind(ValidationCodeInterface::class, ValidationClientCode::class);
        $this->app->bind(UserRegistrationInterface::class, UserRegistrationService::class);
        $this->app->bind(AuthenticationServiceInterface::class, AuthenticationService::class);
    }

    /**
     * Bootstrap any application services.
     */


public function boot()
{
    Response::macro('api', function ($data, $status = 200) {
        return response()->json($data, $status, [], JSON_UNESCAPED_UNICODE);
    });
}
}
