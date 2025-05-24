<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class RatingPlaceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('place_ratings')->insert([
            [
                'user_id'           => 1, 
                'meeting_room_id'   => 1, 
                'rate'              => 5
            ],[
                'user_id'           => 2, 
                'meeting_room_id'   => 2, 
                'rate'              => 4
            ]
        ]);
    }
}
