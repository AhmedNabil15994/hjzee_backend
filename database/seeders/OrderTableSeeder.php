<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            [
                'order_num'         => '20231',
                'type'              => 0,
                'user_id'           => 1,
                'provider_id'       => 1,
                'service_id'       => 1,
                'quantity'          => '1',
                'price'             => 100,
                'final_total'       => 100,
            ],
            [
                'order_num'         => '20232',
                'type'              => 0,
                'user_id'           => 2,
                'provider_id'       => 2,
                'service_id'        => 2,
                'quantity'          => '2',
                'price'             => 200,
                'final_total'       => 200,
            ],

        ]);
        DB::table('orders')->insert([
            [
                'order_num'         => '20233',
                'type'              => 1,
                'user_id'           => 1,
                'provider_id'       => 1,
                'place_id'          => 1,
                'meeting_room_id'   => 1,
                'date'              => date('Y-m-d'),
                'time'              => date('H:i:s'),
                'price'             => 300,
                'final_total'       => 300,
            ],
            [
                'order_num'         => '20234',
                'type'              => 1,
                'user_id'           => 2,
                'provider_id'       => 2,
                'place_id'          => 2,
                'meeting_room_id'   => 2,
                'date'              => date('Y-m-d'),
                'time'              => date('H:i:s'),
                'price'             => 400,
                'final_total'       => 400,
            ],

        ]);
    }
}
