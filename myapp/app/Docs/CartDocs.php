<?php
namespace App\Docs;

use App\Http\Requests\AddToCartRequest;
use Illuminate\Support\Facades\Request;

class CartDocs{
  /**
 * @OA\Post(
 *   path="/api/cart/items",
 *   summary="Add product to cart",
 *   tags={"Cart"},
 *   security={{"bearerAuth":{}}},
 *   @OA\RequestBody(
 *     required=true,
 *     @OA\JsonContent(
 *       type="object",
 *       @OA\Property(property="product_id", type="integer", example="66")
 *     )
 *   ),
 *
 *   @OA\Response(
 *     response=200,
 *     description="The product has been successfully added to the cart"
 *   ),
 *   @OA\Response(
 *   response=404,
 *   description="The specified product was not found"
 *   )
 * )
 */
 public function addToCart(AddToCartRequest $r){}

   /**
 * @OA\Get(
 *   path="/api/cart",
 *   summary="Show cart items",
 *   tags={"Cart"},
 *   security={{"bearerAuth":{}}},
 *
 *   @OA\Response(
 *     response=200,
 *     description="Cart returned successfully"
 *   )
 * )
 */


  public function getToCart(){}

  /**
 * @OA\Patch(
 *   path="/api/cart/items/{ItemId}",
 *   summary="Change product quantity",
 *   tags={"Cart"},
 *   security={{"bearerAuth":{}}},
 *
 *   @OA\Parameter(
 *   name="ItemId",
 *   in="path",
 *   required=true,
 *   description="Cart item ID"
 *   ),
 *
 *   @OA\RequestBody(
 *     required=true,
 *
 *     @OA\JsonContent(
 *       type="object",
 *       @OA\Property(property="quantity", type="integer", example="3")
 *     )
 *   ),
 *
 *   @OA\Response(
 *     response=200,
 *     description="The quantity of the item in the cart has been successfully updated"
 *   ),
 *   @OA\Response(
 *    response=404,
 *    description="Specified product not found in the cart"
 *   ),
 *   @OA\Response(
 *    response=500,
 *    description="Invalid quantity"
 *   )
 * )
 */

  public function changeQuantity(Request $r, $itemId){}

  /**
 * @OA\Delete(
 *   path="/api/cart/items/{ItemId}",
 *   summary="Removing a product from the cart",
 *   tags={"Cart"},
 *   security={{"bearerAuth":{}}},
 *
 *
 *   @OA\Parameter(
 *   name="ItemId",
 *   in="path",
 *   required=true,
 *   description="remove",
 *   @OA\Schema(type="integer", example=77)
 *
 *   ),
 *
 *   @OA\Response(
 *     response=200,
 *     description="Product successfully removed"
 *   ),
 *   @OA\Response(
 *     response=404,
 *     description="Cart product not found"
 *   )
 * )
 */

  public function deleteItem($itemId){}
}
