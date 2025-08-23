<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\TestCase;

class EmailValidTest extends TestCase
{
   use RefreshDatabase;
    /**
     * A basic feature test example.
     */


   public function test_not_valid_email(){
       $response = $this->postJson('/register', [
         'email'=>'testgmail.com',
         'password'=>'192919192',
         'password_confirmation'=>'192919192',
         'name'=>'Artyr'
       ]);
       $response->assertStatus(500);
   }

   public function test_nots_valid_email(){
         $response = $this->postJson('/register', [
           'email'=>'test@gail.com',
           'password'=>'192919192',
           'password_confirmation'=>'192919192',
           'name'=>'Artyr'
         ]);
         $response->assertStatus(500);
}

   public function test_valid_email(){
  $this->withoutExceptionHandling();
         $response = $this->postJson('/api/register', [
           'email'=>'nikoli20199007@gmail.com',
           'password'=>'192919192',
           'password_confirmation'=>'192919192',
           'name'=>'Artyr'
         ]);
         $response->assertStatus(200);

}


}
