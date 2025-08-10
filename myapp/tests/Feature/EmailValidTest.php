<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\TestCase;

class EmailValidTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

   public function test_not_valid_email(){
       $response = $this->postJson('/', [
         'email'=>'testgmail.com',
         'password'=>'192919192',
         'password_confirmation'=>'192919192',
         'name'=>'Artyr'
       ]);
       $response->assertStatus(422);
   }

   public function test_nots_valid_email(){
         $response = $this->postJson('/', [
           'email'=>'test@gail.com',
           'password'=>'192919192',
           'password_confirmation'=>'192919192',
           'name'=>'Artyr'
         ]);
         $response->assertStatus(422);
}

   public function test_valid_email(){
         $response = $this->postJson('/', [
           'email'=>'nikolai20199007@gmail.com',
           'password'=>'192919192',
           'password_confirmation'=>'192919192',
           'name'=>'Artyr'
         ]);
         $response->assertStatus(200);

}


}
