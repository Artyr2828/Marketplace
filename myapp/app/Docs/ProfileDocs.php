<?php
namespace App\Docs;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\EmailRequest;
use App\Http\Requests\CheckCodeEmailRequest;
use App\Http\Requests\DataChangeRequest;
/**
 * @OA\Tag(
 *   name="Profile",
 *   description="Profile related endpoints"
 * )
 */

class ProfileDocs{
/**
   * @OA\Get(
   *   path="/api/profile",
   *   summary="Get user profile data",
   *   tags={"Profile"},
   *   security={{"bearerAuth":{}}},
   *   @OA\Response(
   *     response=200,
   *     description="Successfully retrieved user profile data"
   *   )
   * )
   */
  public function getDataUser(){}
/**
   * @OA\Post(
   *   path="/api/profile/data",
   *   summary="change a user data",
   *   tags={"Profile"},
   *   security={{"bearerAuth":{}}},
   *
   *   @OA\RequestBody(
   *    required=true,
   *
   *    @OA\MediaType(
   *      mediaType="multipart/form-data",
   *      @OA\Schema(
   *      type="object",
   *      @OA\Property(property="name",type="string", example="Ivan"),
   *      @OA\Property(property="image",type="string", format="binary")
   *      )
   *    )
   *   ),
   *   @OA\Response(
   *      response=200,
   *      description="change a user data"
   *   )
   * )
    */
public function changeDataUser(DataChangeRequest $r){}

/**
   * @OA\Patch(
   *   path="/api/profile/password",
   *   summary="Update user password",
   *   tags={"Profile"},
   *   security={{"bearerAuth":{}}},
   *
   *   @OA\RequestBody(
   *     required=true,
   *     @OA\JsonContent(
   *       type="object",
   *       @OA\Property(
   *         property="old_password",
   *         type="string",
   *         example="MyOldPassword123"
   *       ),
   *       @OA\Property(
   *         property="new_password",
   *         type="string",
   *         example="MyNewPassword456"
   *       )
   *     )
   *   ),
   *
   *   @OA\Response(
   *     response=200,
   *     description="Password successfully updated"
   *   ),
   *   @OA\Response(
   *       response=422,
   *       description="The current password is Invalid"
   *   )
   * )
   */
public function changePasswordUser(PasswordRequest $r){}

/**
   * @OA\Post(
   *   path="/api/profile/email",
   *   summary="Send code to the email",
   *   tags={"Profile"},
   *   security={{"bearerAuth":{}}},
   *
   *   @OA\RequestBody(
   *     required=true,
   *     @OA\JsonContent(
   *       type="object",
   *       @OA\Property(
   *         property="email",
   *         type="string",
   *         example="test@gmail.com"
   *       )
   *     )
   *   ),
   *   @OA\Response(
   *   response=200,
   *   description="A confirmation code has been sent to the specified email"
   *    ),
   *   @OA\Response(
   *   response=400,
   *   description="You entered the same email as your current one"
   *   )
   * )
   */

public function sendEmailVerificationCode(EmailRequest $r){}
/**
   * @OA\Patch(
   *   path="/api/profile/email",
   *   summary="Update user email",
   *   tags={"Profile"},
   *   security={{"bearerAuth":{}}},
   *
   *   @OA\RequestBody(
   *     required=true,
   *     @OA\JsonContent(
   *       type="object",
   *       @OA\Property(
   *         property="email",
   *         type="string",
   *         example="test@gmail.com"
   *       ),
   *       @OA\Property(
   *          property="code",
   *          type="string",
   *          example="1234"
   *       )
   *     )
   *   ),
   *
   *   @OA\Response(
   *     response=200,
   *     description="Email has been successfully updated"
   *   ),
   *   @OA\Response(
   *     response=400,
   *     description="You entered the same email as your current one"
   *   )
   * )
   */
public function changeEmailUser(CheckCodeEmailRequest $r){}

}
