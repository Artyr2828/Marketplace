<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Role;
use Tests\TestCase;

class EmailValidTest extends TestCase
{
   use RefreshDatabase;
    /**
     * A basic feature test example.
     */


   public function test_not_valid_email(){
      Role::factory()->create();
$this->withoutExceptionHandling();
       $response = $this->postJson('/api/register', [
         'email'=>'testgmail.com',
         'password'=>'192919192',
         'password_confirmation'=>'192919192',
         'name'=>'Artyr',
          'role_id'=>1
       ]);
dump($response->getContent());
       $response->assertStatus(422);
   }

   public function test_nots_valid_email(){
        Role::factory()->create();
$this->withoutExceptionHandling();
         $response = $this->postJson('/api/register', [
           'email'=>'test@',
           'password'=>'192919192',
           'password_confirmation'=>'192919192',
           'name'=>'Artyr',
           'role_id'=>1
         ]);
dump($response->getContent());
         $response->assertStatus(422);
}

   public function test_valid_email(){
   Role::factory()->create();
  $this->withoutExceptionHandling();
         $response = $this->postJson('/api/register', [
           'email'=>'nikoli20199007@gmail.com',
           'password'=>'192919192',
           'password_confirmation'=>'192919192',
           'name'=>'Artyr',
           'role_id'=>1
         ]);
dump($response->getContent());
         $this->assertContains($response->status(), [200, 429]);

}


}
