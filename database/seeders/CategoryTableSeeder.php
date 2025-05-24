<?php
namespace Database\Seeders;


use DB;
use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1
        DB::table('categories')->insert([
            [
                'name'              => json_encode(['en' => 'Programming'  , 'ar' => 'برمجة' ] , JSON_UNESCAPED_UNICODE) , 
                'image'             => 'category.png',
                'type'              => 'service',
                'created_at'        => Carbon::now()
            ],[
                'name'              => json_encode(['en' => 'Sports'  , 'ar' => 'رياضة'] , JSON_UNESCAPED_UNICODE) , 
                'image'             => 'category.png',
                'type'              => 'service',
                'created_at'        => Carbon::now()
            ],[
                'name'              => json_encode(['en' => 'Art'  , 'ar' => 'فنون'] , JSON_UNESCAPED_UNICODE) , 
                'image'              => 'category.png',
                'type'              => 'service',
                'created_at'        => Carbon::now()
            ],[
                'name'              => json_encode(['en' => 'Education'  , 'ar' => 'تعليم'] , JSON_UNESCAPED_UNICODE) , 
                'image'              => 'category.png',
                'type'              => 'service',
                'created_at'        => Carbon::now()
            ],[
                'name'              => json_encode(['en' => 'Centers'  , 'ar' => 'مراكز تعليمية'] , JSON_UNESCAPED_UNICODE) , 
                'image'              => 'category.png',
                'type'              => 'place',
                'created_at'        => Carbon::now()
            ]
        ]);

        DB::table('categories')->insert([
            [
                'parent_id'         => 1 ,
                'name'              => json_encode(['en' => 'Android'  , 'ar' => 'اندرويد'], JSON_UNESCAPED_UNICODE) ,
                'type'              => 'service',
                'image'             => 'category.png',
            ] , [
                'parent_id'         => 1 ,
                'name'              => json_encode(['en' => 'Ios'  , 'ar' => 'ايفون'], JSON_UNESCAPED_UNICODE) ,
                'type'              => 'service',
                'image'             => 'category.png',
            ] , [
                'parent_id'         => 2 ,
                'name'              => json_encode(['en' => 'Football'  , 'ar' => 'كرة قدم'], JSON_UNESCAPED_UNICODE) ,
                'type'              => 'service',
                'image'             => 'category.png',
            ] , [
                'parent_id'         => 2 ,
                'name'              => json_encode(['en' => 'Basketball'  , 'ar' => 'كرة سلة'], JSON_UNESCAPED_UNICODE) ,
                'type'              => 'service',
                'image'             => 'category.png',
            ] , [
                'parent_id'         => 3 ,
                'name'              => json_encode(['en' => 'Pinting'  , 'ar' => 'رسم'], JSON_UNESCAPED_UNICODE) ,
                'type'              => 'service',
                'image'             => 'category.png',
            ] , [
                'parent_id'         => 3 ,
                'name'              => json_encode(['en' => 'Rocks'  , 'ar' => 'صخور'], JSON_UNESCAPED_UNICODE) ,
                'type'              => 'service',
                'image'             => 'category.png',
                
            ] , [
                'parent_id'         => 4 ,
                'name'              => json_encode(['en' => 'Employee Course'  , 'ar' => 'دورات توظيف'], JSON_UNESCAPED_UNICODE) ,
                'type'              => 'service',
                'image'             => 'category.png',
                
            ]
        ]);
    }
}
