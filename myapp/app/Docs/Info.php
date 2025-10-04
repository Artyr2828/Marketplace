<?php
namespace App\Docs;
/**
 * @OA\Info(
 *   version="1.0.0",
 *   title="my Api"
 * )
 *
 * @OA\SecurityScheme(
 *   securityScheme="bearerAuth",
 *   type="http",
 *   scheme="bearer",
 *   bearerFormat="JWT"
 * )
 */
class Info{}
