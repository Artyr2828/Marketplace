<?php
namespace App\Services\Email;

class GenerateEmailCode{
  function generate(){
     return random_int(1000, 9999);
  }
}
