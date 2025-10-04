<?php
namespace App\Docs;

class HomePageDocs{

/**
 * @OA\Get(
 *     path="/api/home/",
 *     summary="Получить список продуктов для главной страницы",
 *     description="Возвращает список продуктов (с изображениями), ограниченный 10 элементами.",
 *     tags={"Home"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Response(
 *         response=200,
 *         description="Список продуктов успешно получен",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=80),
 *                 @OA\Property(property="user_id", type="integer", example=28),
 *                 @OA\Property(property="name", type="string", example="new Mobile"),
 *                 @OA\Property(property="price", type="string", example="78000"),
 *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-10-01T09:54:31.000000Z"),
 *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-10-02T00:21:23.000000Z"),
 *                 @OA\Property(
 *                     property="img__connect",
 *                     type="array",
 *                     @OA\Items(
 *                         type="object",
 *                         @OA\Property(property="id", type="integer", example=99),
 *                         @OA\Property(property="product_id", type="integer", example=80),
 *                         @OA\Property(property="path", type="string", example="images/device/68dcfa57efc08.jpg"),
 *                         @OA\Property(property="created_at", type="string", format="date-time", example="2025-10-01T09:54:33.000000Z"),
 *                         @OA\Property(property="updated_at", type="string", format="date-time", example="2025-10-01T09:54:33.000000Z")
 *                     )
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Неавторизован (требуется Bearer токен)"
 *     )
 * )
 */

  public function getDataHomePage(){}


  /**
 * @OA\Get(
 *     path="/api/home/search/{query}",
 *     summary="Поиск продуктов",
 *     description="Возвращает список продуктов по ключевому слову.",
 *     tags={"Home"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Parameter(
 *         name="query",
 *         in="path",
 *         description="Поисковый запрос",
 *         required=true,
 *         @OA\Schema(type="string", example="comp")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Список найденных продуктов",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                 property="product",
 *                 type="array",
 *                 @OA\Items(
 *                     type="object",
 *                     @OA\Property(property="id", type="integer", example=82),
 *                     @OA\Property(property="user_id", type="integer", example=28),
 *                     @OA\Property(property="name", type="string", example="computer"),
 *                     @OA\Property(property="price", type="string", example="12000"),
 *                     @OA\Property(property="created_at", type="string", format="date-time"),
 *                     @OA\Property(property="updated_at", type="string", format="date-time"),
 *                     @OA\Property(
 *                         property="img__connect",
 *                         type="array",
 *                         @OA\Items(
 *                             type="object",
 *                             @OA\Property(property="id", type="integer", example=103),
 *                             @OA\Property(property="product_id", type="integer", example=82),
 *                             @OA\Property(property="path", type="string", example="images/device/68ddef143fd17.jpg"),
 *                             @OA\Property(property="created_at", type="string", format="date-time"),
 *                             @OA\Property(property="updated_at", type="string", format="date-time")
 *                         )
 *                     )
 *                 )
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Неавторизован (нет Bearer токена)"
 *     )
 * )
 */


   public function search(string $word){}

}
