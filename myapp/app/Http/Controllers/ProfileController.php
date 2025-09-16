<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Predis\Command\Redis\Json\JSONDEL;

class ProfileController extends Controller
{
   /**
 * отдать данные пользователя
 * @return JSON
   **/

    public function getDataUser(){
       $user = auth()->user();
       return response()->api($user->load('image'));
    }
}
