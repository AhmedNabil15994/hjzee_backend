<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class RatingProviderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('provider_ratings')->insert([
            [
                'user_id'           => 1, 
                'provider_id'        => 1, 
                'rate'              => 5
            ],[
                'user_id'           => 2, 
                'provider_id'        => 2, 
                'rate'              => 4
            ]
        ]);
    }
}
