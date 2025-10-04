<?php
namespace App\Docs;
use App\Http\Requests\StoreOrderRequest;
class OrderDocs{

  /**
 * @OA\Post(
 *     path="/api/orders",
 *     summary="Create a new order",
 *     tags={"Orders"},
 *     security={{"bearerAuth":{}}},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             required={"address","phone"},
 *             @OA\Property(property="address", type="string", example="Пушкина/Калатушкина"),
 *             @OA\Property(property="phone", type="string", example="+8189888997"),
 *             @OA\Property(property="comment", type="string", example="Хочу в красном")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Order created successfully.",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="ok")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized. Missing or invalid token.",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="Unauthenticated.")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Cart is empty, order cannot be created.",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="error"),
 *             @OA\Property(property="error", type="string", example="Your cart is empty")
 *         )
 *     )
 * )
 */
public function store(StoreOrderRequest $r) {}


/**
 * @OA\Get(
 *     path="/api/orders/order_items",
 *     summary="Get user orders with items",
 *     tags={"Orders"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=200,
 *         description="List of orders with order items",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=42),
 *                 @OA\Property(property="user_id", type="integer", example=20),
 *                 @OA\Property(property="address", type="string", example="Пушкина/Калатушкина"),
 *                 @OA\Property(property="phone", type="string", example="+8189888997"),
 *                 @OA\Property(property="comment", type="string", example="Хочу в красном"),
 *                 @OA\Property(property="status", type="string", example="pending"),
 *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-10-02T23:16:05.000000Z"),
 *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-10-02T23:16:05.000000Z"),
 *                 @OA\Property(
 *                     property="order_items",
 *                     type="array",
 *                     @OA\Items(
 *                         type="object",
 *                         @OA\Property(property="id", type="integer", example=33),
 *                         @OA\Property(property="order_id", type="integer", example=42),
 *                         @OA\Property(property="product_id", type="integer", example=80),
 *                         @OA\Property(property="price", type="number", example=78000),
 *                         @OA\Property(property="quantity", type="integer", example=1),
 *                         @OA\Property(property="created_at", type="string", format="date-time", example="2025-10-02T23:16:05.000000Z"),
 *                         @OA\Property(property="updated_at", type="string", format="date-time", example="2025-10-02T23:16:05.000000Z")
 *                     )
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized. Missing or invalid token.",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="Unauthenticated.")
 *         )
 *     )
 * )
 */
public function getOrderItems() {}
}
