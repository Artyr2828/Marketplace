<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Role;
use Mockery;
class RegistrationControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
use RefreshDatabase;
    public function test_handle_post(): void
    {

Role::factory()->create();
        $response = $this->post('/api/register', [
           'name'=>'Artyr',
           'email'=>'nikololi@gmail.com',
           'password'=>'1929929919',
            'password_confirmation'=>'1929929919'
        ]);

       dump($response->getContent());
       $this->assertContains($response->status(), [200, 429]);
    }

    public function test_checkCode_post(): void{
    $this->withoutExceptionHandling();
    $mock = Mockery::mock(\App\Interfaces\ValidationCodeInterface::class);
    $mock->shouldReceive('validation')->once()->andReturn(true);
    $this->app->instance(\App\Interfaces\ValidationCodeInterface::class, $mock);

    $mockCodeStorage = Mockery::mock(\App\Interfaces\VerificationCodeInterface::class);
    $mockCodeStorage->shouldReceive('getCode')->once()->andReturn('1234');
    $mockCodeStorage->shouldReceive('delKey')->andReturn(null);
    $this->app->instance(\App\Interfaces\VerificationCodeInterface::class, $mockCodeStorage);

    $mockUser = Mockery::mock(\App\Interfaces\UserRegistrationInterface::class);
    $mockUser->shouldReceive('getUser')->andReturn(new \App\Models\User(['name'=>'Artyr', 'email'=>'test@gmail.com', 'password'=>'12345678', 'password_confirmation'=>'12345678']));
    $mockUser->shouldReceive('changeDataInDB')->andReturn(null);
    $this->app->instance(\App\Interfaces\UserRegistrationInterface::class, $mockUser);


      $response = $this->postJson('/api/register/check-code/',[
           'code'=>'1234',
           'email'=>'nikololi@gmail.com'
      ]);
     $response->assertStatus(200);
    }
}
