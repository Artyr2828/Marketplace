<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AuthControllerTest extends TestCase
{
use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_login(): void
    {
      $this->withoutExceptionHandling();
        $user = User::factory()->create([
           'name'=>'Artyr',
           'email'=>'test201007@gmail.com',
           'password'=>Hash::make('123456789')
        ]);

        $response = $this->postJson('/api/login', ['email'=>'test201007@gmail.com', 'password'=>'123456789']);

        $response->assertStatus(200);

    }
}
