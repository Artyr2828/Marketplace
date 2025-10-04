<?php
namespace App\Docs;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\CheckCodeEmailRequest;
use App\Http\Requests\RegenerateCodeRequest;

class RegistrationDocs{

/**
 * @OA\Post(
 *     path="/api/register",
 *     summary="Register a new user and send confirmation code",
 *     tags={"Auth"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="name", type="string", example="Artyr"),
 *             @OA\Property(property="email", type="string", format="email", example="stop@gmail.com"),
 *             @OA\Property(property="password", type="string", format="password", example="12345678"),
 *             @OA\Property(property="password_confirmation", type="string", format="password", example="12345678")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Registration successful. Confirmation code required.",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="ok"),
 *             @OA\Property(property="message", type="string", example="Registration successful, code confirmation required")
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Email is already in use.",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="error"),
 *             @OA\Property(property="error", type="string", example="Email in use")
 *         )
 *     )
 * )
 */
public function handlePost(RegisterRequest $r) {}


/**
 * @OA\Post(
 *     path="/api/register/check-code",
 *     summary="Verify email confirmation code",
 *     tags={"Auth"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="email", type="string", format="email", example="stop@gmail.com"),
 *             @OA\Property(property="code", type="string", example="7284")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Code confirmed, registration successful.",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="Code confirmed, registration successful")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Email not found.",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="error"),
 *             @OA\Property(property="error", type="string", example="Email not found")
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Invalid confirmation code.",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="error"),
 *             @OA\Property(property="error", type="string", example="Invalid Code")
 *         )
 *     )
 * )
 */
public function checkCode(CheckCodeEmailRequest $r) {}

/**
 * @OA\Post(
 *     path="/api/register/regenerateCode",
 *     summary="Regenerate email confirmation code",
 *     tags={"Auth"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="email", type="string", format="email", example="testr201007@gmail.com")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="New confirmation code has been sent.",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="message", type="string", example="New confirmation code has been sent")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Email not found.",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="status", type="string", example="error"),
 *             @OA\Property(property="error", type="string", example="Email not found")
 *         )
 *     )
 * )
 */
public function regenerateCode(RegenerateCodeRequest $r) {}
}
