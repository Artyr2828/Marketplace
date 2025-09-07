<?php
namespace App\Interfaces;
use App\Models\User;
interface AuthenticationServiceInterface{
   public function authentication(array $creditails): string;
   public function EnsureEmailIsVerified(User $user): void;
}
