<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
class HomeControllerTest extends TestCase
{
    use RefreshDatabase;/**
     * A basic feature test example.
     */
    public function test_handle_get(): void

    {

       $this->withoutMiddleware(/* \Tymon\JWTAuth\Http\Middleware\Authenticate::class */);
       $this->withoutExceptionHandling();
       $user = User::factory()->create();
       $this->actingAs($user, 'api');
        $response = $this->withHeaders(["Accept"=>"applicaton/json"])->get('/api/home');

        $response->assertStatus(200);
    }

   public function test_search_get(){
     $this->withExceptionHandling();
      $this->withoutMiddleware();
      $user = User::factory()->create();
      $this->actingAs($user, 'api');
      $response = $this->get('/api/home?search=n');
    dump($response->getContent());
    $response->assertStatus(200);
   }

}
