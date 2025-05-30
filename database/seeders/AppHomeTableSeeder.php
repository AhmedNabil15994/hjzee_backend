<?php
namespace Database\Seeders;


use DB;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AppHomeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('app_homes')->insert([
            [
                'title'              => json_encode(['en' => 'ads'  , 'ar' => 'اعلانات' ] , JSON_UNESCAPED_UNICODE) , 
                'description'        => json_encode(['en' => 'ads'  , 'ar' => 'اعلانات' ] , JSON_UNESCAPED_UNICODE) , 
                'type'               => 'ads',
                'sort'               => 1,
                'records'            => json_encode([1,2]),
            ],
            [
                'title'              => json_encode(['en' => 'services'  , 'ar' => 'كورسات' ] , JSON_UNESCAPED_UNICODE) , 
                'description'        => json_encode(['en' => 'services'  , 'ar' => 'كورسات' ] , JSON_UNESCAPED_UNICODE) , 
                'type'               => 'services',
                'sort'               => 2,
                'records'            => json_encode([1,2]),
            ],
            [
                'title'              => json_encode(['en' => 'places'  , 'ar' => 'اماكن' ] , JSON_UNESCAPED_UNICODE) , 
                'description'        => json_encode(['en' => 'places'  , 'ar' => 'اماكن' ] , JSON_UNESCAPED_UNICODE) , 
                'type'               => 'places',
                'sort'               => 3,
                'records'            => json_encode([1,2]),
            ],
            [
                'title'              => json_encode(['en' => 'categories'  , 'ar' => 'اقسام' ] , JSON_UNESCAPED_UNICODE) , 
                'description'        => json_encode(['en' => 'categories'  , 'ar' => 'اقسام' ] , JSON_UNESCAPED_UNICODE) , 
                'type'               => 'categories',
                'sort'               => 4,
                'records'            => json_encode([1,2]),
            ],
            [
                'title'              => json_encode(['en' => 'description'  , 'ar' => 'وصف' ] , JSON_UNESCAPED_UNICODE) , 
                'description'        => json_encode(['en' => 'description'  , 'ar' => 'وصف' ] , JSON_UNESCAPED_UNICODE) , 
                'type'               => 'description',
                'sort'               => 5,
                'records'            => null,
            ],
        ]);
    }
}
