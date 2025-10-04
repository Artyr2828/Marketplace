<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Services\HomePage\HomePageService;
use Psy\Util\Json;

class HomeController extends Controller
{
   private $homePageService;
   public function __construct(HomePageService $homePageService){
       $this->homePageService = $homePageService;
   }

    /**
 * Отдаем 10 продуктов для главной страницы
 * @return Json
 */

    public function getDataHomePage(){
     //отдаем прлдукты с лимтом 10
     $products = $this->homePageService->getProducts();
     return response()->api($products);
    }

   /**
 * Поиск продукта в БД
 * @param Request $r продукт который хочет найти пользователь
 */

    public function search(string $word){
      $product = $this->homePageService->searchProduct($word);

      return response()->api(['product'=>$product]);
    }
}
