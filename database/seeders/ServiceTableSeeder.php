<?php
namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            [
                'name'              => json_encode(['en' => 'Programming'  , 'ar' => 'تدريب برمجة' ] , JSON_UNESCAPED_UNICODE) , 
                'provider_id'       => 1,
                'place_id'          => 1,
                'category_id'       => 1,
                'description'       => json_encode(['en' => 'Programming very strong course'  , 'ar' => 'دورة برمجية قوية جدا' ] , JSON_UNESCAPED_UNICODE) , 
                'times'             => json_encode(['en' => 'sunday from 10 AM to 11 AM'  , 'ar' => 'الأحد من  ١٠ص الي ١١ ص' ] , JSON_UNESCAPED_UNICODE) , 
                'start_date'        => '2024-01-01 10:00:00',
                'price'             => '100',
                'offer_price'       => '80',
                'num_seats'         => 20,
                'address'           => '40 omar street',
                'options'           => json_encode(['1','2']),
            ],[
                'name'              => json_encode(['en' => 'Sports'  , 'ar' => 'تدريب كرة'] , JSON_UNESCAPED_UNICODE) , 
                'provider_id'       => 2,
                'place_id'          => 2,
                'category_id'       => 2,
                'description'       => json_encode(['en' => 'Sports very strong course'  , 'ar' => 'دورة تدريب كرة قدم قوية جدا' ] , JSON_UNESCAPED_UNICODE) , 
                'times'             => json_encode(['en' => 'sunday from 10 AM to 11 AM'  , 'ar' => 'الأحد من  ١٠ص الي ١١ ص' ] , JSON_UNESCAPED_UNICODE) , 
                'start_date'        => '2024-01-01 10:00:00',
                'price'             => '200',
                'offer_price'       => '180',
                'num_seats'         => 20,
                'address'           => '40 omar street',
                'options'           => json_encode(['1','2']),
            ]
        ]);
    }
}
