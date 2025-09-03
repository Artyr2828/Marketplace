<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Carts;
use App\Models\CartItems;
class CartControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_add_to_cart(): void
    {
        $this->withExceptionHandling();
        Product::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->post('/api/cart/items', ['product_id'=>3]);
        $response->dump();
        $response->assertStatus(200);
    }

   public function test_change_quantity(){
     $this->withExceptionHandling();
     Product::factory()->create();
     Carts::factory()->create();
     CartItems::factory()->create();
    $user = User::factory()->create();
    $this->actingAs($user);
    $response = $this->patch('/api/cart/items/1', ['quantity'=>3]);

   $response->dump();
    $response->assertStatus(200);
   }
}
