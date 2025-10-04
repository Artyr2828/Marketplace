<?php
namespace App\Docs;

/**
 * @OA\Get(
 *   path="/api/product/{id}",
 *   summary="Show products(limit 10)",
 *   tags={"Products"},
 *   security={{"bearerAuth":{}}},
 *
 *   @OA\Parameter(
 *     name="id",
 *     in="path",
 *     required=true,
 *     description="Id Product",
 *     @OA\Schema(
 *       type="integer",
 *       example=10
 *     )
 *   ),
 *
 *   @OA\Response(
 *     response=200,
 *     description="Ok, Product Retrieved Successfully"
 *   ),
 *   @OA\Response(
 *     response=404,
 *     description="product not found"
 *   )
 * )
 */

class ProductPageDocs{}
