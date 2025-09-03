<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Carts;
use App\Models\CartItems;
class OrderControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_store(): void
    {
        $this->withExceptionHandling();
        $this->withoutMiddleware();

        $user = User::factory()->create();
        $this->actingAs($user);

        Product::factory()->create();
        Carts::factory()->create();
        CartItems::factory()->create();

        $response = $this->post('/api/orders', [
            'product_id'=>3,
            'address'=>'Пушкина',
            'phone'=>'+8891919',
            'quantity'=>3
        ]);
        $response->dump();

        $response->assertStatus(200);
    }
}
