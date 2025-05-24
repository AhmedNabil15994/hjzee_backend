<?php
namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class PlaceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('places')->insert([
            [
                'name'              => json_encode(['en' => 'qma center'  , 'ar' => 'مركز القمة' ] , JSON_UNESCAPED_UNICODE) ,
                'description'       => json_encode(['en' => 'qma center is the best'  , 'ar' => ' مركز القمة المركز الافضل' ] , JSON_UNESCAPED_UNICODE) ,
                'provider_id'       => 1,
                'city_id'           => 1,
                'category_id'       => 1,
                'lat'               => '47.364567654', 
                'lng'               => '29.1666987654', 
                'address'           => 'kuwait,kuwait',
            ],[
                'name'              => json_encode(['en' => 'Nour center'  , 'ar' => 'مركز النور'] , JSON_UNESCAPED_UNICODE) , 
                'description'       => json_encode(['en' => 'Nour center is the best'  , 'ar' => 'مركز النور المركز الافضل'] , JSON_UNESCAPED_UNICODE) , 
                'provider_id'       => 2,
                'city_id'           => 2,
                'category_id'       => 2,
                'lat'               => '47.364567654', 
                'lng'               => '29.1666987654', 
                'address'           => 'kuwait,kuwait',
            ]
        ]);
    }
}
