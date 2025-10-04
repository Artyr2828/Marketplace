<?php
namespace App\Docs;

/**
 * @OA\Post(
 *   path="/api/login",
 *   summary="Get a JWT token",
 *   tags={"Auth"},
 *
 *   @OA\RequestBody(
 *     required=true,
 *     @OA\JsonContent(
 *       type="object",
 *       @OA\Property(property="email", type="string", example="test@gmail.com"),
 *       @OA\Property(property="password", type="string", example="12345678")
 *     )
 *   ),
 *
 *   @OA\Response(
 *     response=200,
 *     description="JWT Token Generated Successfully"
 *   )
 * )
 */

class AuthDocs{}
