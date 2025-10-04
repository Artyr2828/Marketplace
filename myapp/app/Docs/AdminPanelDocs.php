<?php
namespace App\Docs;
use Illuminate\Support\Facades\Request;
class AdminPanelDocs{

   /**
 * @OA\Get(
 *   path="/api/admin",
 *   summary="Get admin’s products",
 *   tags={"AdminPanel"},
 *   security={{"bearerAuth":{}}},
 *
 *   @OA\Response(
 *     response=200,
 *     description="Admin products successfully returned"
 *   ),
 *   @OA\Response(
 *     response=500,
 *     description="Access to the content is forbidden"
 * )
 * )
 */

   public function getProductItems(){}
/**
 * @OA\Post(
 *   path="/api/admin/product/{ItemId}",
 *   summary="Update admin product",
 *   tags={"AdminPanel"},
 *   security={{"bearerAuth":{}}},
 *
 *   @OA\Parameter(
 *     name="ItemId",
 *     in="path",
 *     required=true,
 *     description="Product ID",
 *     @OA\Schema(type="integer", example=66)
 *   ),
 *
 *   @OA\RequestBody(
 *     required=true,
 *     @OA\MediaType(
 *       mediaType="multipart/form-data",
 *       @OA\Schema(
 *         type="object",
 *         @OA\Property(
 *           property="_method",
 *           type="string",
 *           example="PATCH",
 *           description="Laravel method override"
 *         ),
 *         @OA\Property(property="name", type="string", example="new Mobile"),
 *         @OA\Property(property="price", type="integer", example=78000),
 *         @OA\Property(property="description", type="string", example="New Description"),
 *
 *         @OA\Property(
 *           property="images",
 *           type="array",
 *           @OA\Items(type="string", format="binary"),
 *           description="Array of new images to add"
 *         ),
 *
 *         @OA\Property(
 *           property="replace",
 *           type="object",
 *           description="Object where keys = image IDs to replace, values = new image files.
 *                        ⚠️ Swagger UI не поддерживает загрузку файлов в объекте, используйте curl/Postman.",
 *           @OA\AdditionalProperties(
 *             type="string",
 *             format="binary"
 *           ),
 *           example={"52": "file.jpg", "53": "another.png"}
 *         ),
 *
 *         @OA\Property(
 *           property="delete",
 *           type="array",
 *           @OA\Items(type="integer", example=52),
 *           description="IDs of images to delete"
 *         )
 *       )
 *     )
 *   ),
 *
 *   @OA\Response(
 *     response=200,
 *     description="Product successfully updated"
 *   ),
 * )
 */
   public function update(Request $r, int $itemId){}


  /**
 * @OA\Post(
 *   path="/api/admin/product-store",
 *   summary="Create new product (with images)",
 *   tags={"AdminPanel"},
 *   security={{"bearerAuth":{}}},
 *
 *   @OA\RequestBody(
 *     required=true,
 *     @OA\MediaType(
 *       mediaType="multipart/form-data",
 *       @OA\Schema(
 *         type="object",
 *         required={"name", "price", "description", "images"},
 *
 *         @OA\Property(property="name", type="string", example="computer"),
 *         @OA\Property(property="price", type="integer", example=12000),
 *         @OA\Property(property="description", type="string", example="Тестовый продукт"),
 *
 *         @OA\Property(
 *           property="images",
 *           type="array",
 *           @OA\Items(type="string", format="binary"),
 *           description="One or more product images"
 *         ),
 *
 *         @OA\Property(
 *           property="other_field",
 *           type="string",
 *           example="value",
 *           description="Optional additional field"
 *         )
 *       )
 *     )
 *   ),
 *
 *   @OA\Response(
 *     response=200,
 *     description="Product successfully listed",
 *     @OA\JsonContent(
 *       type="object",
 *       @OA\Property(property="status", type="string", example="ok"),
 *       @OA\Property(property="message", type="string", example="Product successfully listed")
 *     )
 *   ),
 *
 *   @OA\Response(
 *     response=422,
 *     description="Validation error (e.g. no photo uploaded)",
 *     @OA\JsonContent(
 *       type="object",
 *       @OA\Property(property="status", type="string", example="error"),
 *       @OA\Property(property="error", type="string", example="Photo not uploaded")
 *     )
 *   )
 * )
 */
   public function store(Request $r){}


   /**
 * @OA\Delete(
 *   path="/api/admin/product/{itemId}",
 *   summary="Delete product",
 *   tags={"AdminPanel"},
 *   security={{"bearerAuth":{}}},
 *
 *   @OA\Parameter(
 *     name="itemId",
 *     in="path",
 *     required=true,
 *     description="ID of the product to delete",
 *     @OA\Schema(type="integer", example=77)
 *   ),
 *
 *   @OA\Response(
 *     response=200,
 *     description="Product successfully deleted",
 *     @OA\JsonContent(
 *       type="object",
 *       @OA\Property(property="status", type="string", example="ok"),
 *       @OA\Property(property="message", type="string", example="Product successfully deleted")
 *     )
 *   ),
 *
 *   @OA\Response(
 *     response=403,
 *     description="User not authorized to delete this product",
 *     @OA\JsonContent(
 *       type="object",
 *       @OA\Property(property="status", type="string", example="error"),
 *       @OA\Property(property="error", type="string", example="You are not authorized to access this product")
 *     )
 *   ),
 *
 *   @OA\Response(
 *     response=409,
 *     description="Conflict: product cannot be deleted",
 *     @OA\JsonContent(
 *       type="object",
 *       @OA\Property(property="status", type="string", example="error"),
 *       @OA\Property(property="error", type="string", example="This product cannot be deleted as there are existing orders for it")
 *     )
 *   )
 * )
 */

   public function delete(int $itemId){}


   /**
 * @OA\Post(
 *   path="/api/admin/orders/{orderId}",
 *   summary="Update order status",
 *   tags={"AdminPanel"},
 *   security={{"bearerAuth":{}}},
 *
 *   @OA\Parameter(
 *     name="orderId",
 *     in="path",
 *     required=true,
 *     description="ID of the order to update",
 *     @OA\Schema(type="integer", example=365)
 *   ),
 *
 *   @OA\RequestBody(
 *     required=true,
 *     @OA\JsonContent(
 *       type="object",
 *       @OA\Property(
 *         property="transition",
 *         type="string",
 *         example="pay",
 *         description="Transition to apply to the order (depends on state machine)"
 *       )
 *     )
 *   ),
 *
 *   @OA\Response(
 *     response=200,
 *     description="Status successfully updated",
 *     @OA\JsonContent(
 *       type="object",
 *       @OA\Property(property="status", type="string", example="ok"),
 *       @OA\Property(property="message", type="string", example="Status successfully updated")
 *     )
 *   ),
 *
 *   @OA\Response(
 *     response=500,
 *     description="Status update error",
 *     @OA\JsonContent(
 *       type="object",
 *       @OA\Property(property="status", type="string", example="error"),
 *       @OA\Property(property="error", type="string", example="Status update error.")
 *     )
 *   )
 * )
 */

  public function updateStatus(int $orderId, Request $r){}

/**
 * @OA\Get(
 *     path="/api/admin/orders",
 *     summary="Список всех заказов (только для администратора)",
 *     description="Возвращает список всех заказов вместе с товарами и пользователями (только для администратора).",
 *     tags={"AdminPanel"},
 *     security={{"bearerAuth": {}}},
 *
 *     @OA\Response(
 *         response=200,
 *         description="Список заказов с данными пользователей и товаров",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="order_id", type="integer", example=6),
 *                 @OA\Property(property="user_id", type="integer", example=28),
 *                 @OA\Property(property="product_id", type="integer", example=80),
 *                 @OA\Property(property="seller_id", type="integer", example=28),
 *                 @OA\Property(property="price", type="number", example=78000),
 *                 @OA\Property(property="quantity", type="integer", example=1),
 *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-10-03T23:24:12.000000Z"),
 *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-10-03T23:24:12.000000Z"),
 *
 *                 @OA\Property(
 *                     property="orders",
 *                     type="object",
 *                     @OA\Property(property="id", type="integer", example=6),
 *                     @OA\Property(property="user_id", type="integer", example=28),
 *                     @OA\Property(property="address", type="string", example="Пушкина"),
 *                     @OA\Property(property="phone", type="string", example="+79804994994"),
 *                     @OA\Property(property="comment", type="string", example="Дом калатушкина"),
 *                     @OA\Property(property="status", type="string", example="delivered"),
 *                     @OA\Property(property="created_at", type="string", format="date-time"),
 *                     @OA\Property(property="updated_at", type="string", format="date-time"),
 *
 *                     @OA\Property(
 *                         property="user",
 *                         type="object",
 *                         @OA\Property(property="id", type="integer", example=28),
 *                         @OA\Property(property="name", type="string", example="TestName"),
 *                         @OA\Property(property="email", type="string", example="test@gmail.com"),
 *                         @OA\Property(property="email_verified_at", type="string", format="date-time"),
 *                         @OA\Property(property="role_id", type="integer", example=2),
 *                         @OA\Property(property="created_at", type="string", format="date-time"),
 *                         @OA\Property(property="updated_at", type="string", format="date-time")
 *                     )
 *                 ),
 *
 *                 @OA\Property(
 *                     property="product",
 *                     type="object",
 *                     @OA\Property(property="id", type="integer", example=80),
 *                     @OA\Property(property="user_id", type="integer", example=28),
 *                     @OA\Property(property="name", type="string", example="new Mobile"),
 *                     @OA\Property(property="price", type="string", example="78000"),
 *                     @OA\Property(property="created_at", type="string", format="date-time"),
 *                     @OA\Property(property="updated_at", type="string", format="date-time"),
 *
 *                     @OA\Property(
 *                         property="img__connect",
 *                         type="array",
 *                         @OA\Items(
 *                             type="object",
 *                             @OA\Property(property="id", type="integer", example=99),
 *                             @OA\Property(property="product_id", type="integer", example=80),
 *                             @OA\Property(property="path", type="string", example="images/device/68dcfa57efc08.jpg"),
 *                             @OA\Property(property="created_at", type="string", format="date-time"),
 *                             @OA\Property(property="updated_at", type="string", format="date-time")
 *                         )
 *                     )
 *                 )
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Неавторизован или нет прав доступа"
 *     ),
 *     @OA\Response(
 *         response=403,
 *         description="Доступ к контенту запрещен"
 *     )
 * )
 */

 public function getOrders(){}
}
