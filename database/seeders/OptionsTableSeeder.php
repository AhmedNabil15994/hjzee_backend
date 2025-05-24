<?php
namespace Database\Seeders;


use DB;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('options')->insert([
                    [
                        'name'            => json_encode(['en' => 'LED screens '  , 'ar' => 'شاشات LED' ] , JSON_UNESCAPED_UNICODE),
                    ],
                    [
                        'name'            => json_encode(['en' => 'Free Hospitality'  , 'ar' => 'الضيافة المجانية' ] , JSON_UNESCAPED_UNICODE),
                    ],
                    [
                        'name'            => json_encode(['en' => 'Wifi'  , 'ar' => 'واى فاى' ] , JSON_UNESCAPED_UNICODE),
                    ],
                    [
                        'name'            => json_encode(['en' => 'Males '  , 'ar' => 'ذكور' ] , JSON_UNESCAPED_UNICODE),
                    ],
                    [
                        'name'            => json_encode(['en' => 'Females'  , 'ar' => 'آناث' ] , JSON_UNESCAPED_UNICODE),
                    ],
                    [
                        'name'            => json_encode(['en' => '15-60 years'  , 'ar' => '١٥-٦٠ سنة' ] , JSON_UNESCAPED_UNICODE),
                    ],

                ]);
    }
}
