<?php
namespace App\Interfaces;

interface ValidationCodeInterface{
   public function validation(string $clientCode, string $validCode);
}
