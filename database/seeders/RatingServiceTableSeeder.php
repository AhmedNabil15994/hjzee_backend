<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class RatingServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('service_ratings')->insert([
            [
                'user_id'           => 1, 
                'service_id'        => 1, 
                'rate'              => 5
            ],[
                'user_id'           => 2, 
                'service_id'        => 2, 
                'rate'              => 4
            ]
        ]);
    }
}
