<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DescSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
  /*      DB::table('description_product')->insert([
           'product_id'=>1,
            'desc'=>'Samsung Galaxy J7 – это смартфон среднего класса от компании Samsung, выпускавшийся в нескольких поколениях (2015–2017 годы). Он оснащён 5,5-дюймовым Super AMOLED дисплеем, восьмиядерным процессором, 13-мегапиксельной основной камерой, аккумулятором на 3000 мА·ч и поддержкой двух SIM-карт. Отличался хорошим экраном и надёжной батареей, что делало его популярным в своё время среди доступных моделей.'
        ]);

*/
  //    DB::table('description_product')->insert([
    //         'product_id'=>1,
        //      'desc'=>''
     // ]);

      DB::table('description_product')->insert([
               'product_id'=>93,
                'desc'=>'Nvidia — мощное и надёжное решение для игр, работы с графикой и искусственным интеллектом. Высокая производительность, современная архитектура и поддержка новейших технологий обеспечивают плавный геймплей, ускоренный рендеринг и комфортную работу даже с самыми тяжёлыми задачами.'
        ]);

      DB::table('description_product')->insert([
               'product_id'=>94,
                'desc'=>'Стильные и удобные наушники с чистым звуком и глубокими басами. Отлично подходят для игр и общения'
        ]);

      DB::table('description_product')->insert([
               'product_id'=>95,
                'desc'=>'Качественный джойстик с высокой точностью управления. Подходит для игр на ПК и консолях, присутствует быстрый отклик!, а также хорошее управления'
        ]);
    }
}
