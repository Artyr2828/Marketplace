<?php
namespace App\Interfaces;
interface AuthenticationServiceInterface{
   public function authentication(array $creditails): string;
}
