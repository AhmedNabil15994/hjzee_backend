<?php
namespace Database\Seeders;


use DB;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class MeetingRoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('meeting_rooms')->insert([
            [
                'place_id'          => 1,
                'category_id'       => 1,
                'name'              => json_encode(['en' => 'Advisor Room'  , 'ar' => 'غرفة استشارية' ] , JSON_UNESCAPED_UNICODE) , 
                'description'       => json_encode(['en' => 'Advisor Room'  , 'ar' => 'غرفة استشارية' ] , JSON_UNESCAPED_UNICODE) , 
                'price'             => 100,
                'offer_price'       => 80,
                'num_seats'         => 20,
                'rate'              => 4,
                'num_rating'        => 1,
                'options'           => json_encode(['1','2']),
            ],
            [
                'place_id'          => 1,
                'category_id'       => 1,
                'name'              => json_encode(['en' => 'Conference Room'  , 'ar' => 'غرفة المؤتمرات' ] , JSON_UNESCAPED_UNICODE) , 
                'description'       => json_encode(['en' => 'Conference Room'  , 'ar' => 'غرفة المؤتمرات' ] , JSON_UNESCAPED_UNICODE) , 
                'price'             => 100,
                'offer_price'       => 80,
                'num_seats'         => 20,
                'rate'              => 4,
                'num_rating'        => 1,
                'options'           => json_encode(['1','2']),
            ],
            [
                'place_id'          => 2,
                'category_id'       => 2,
                'name'              => json_encode(['en' => 'Executive Room'  , 'ar' => 'غرفة تنفيذية' ] , JSON_UNESCAPED_UNICODE) , 
                'description'       => json_encode(['en' => 'Executive Room'  , 'ar' => 'غرفة تنفيذية' ] , JSON_UNESCAPED_UNICODE) , 
                'price'             => 100,
                'offer_price'       => 80,
                'num_seats'         => 20,
                'rate'              => 4,
                'num_rating'        => 1,
                'options'           => json_encode(['1','2']),
            ],
        ]);

        DB::table('meeting_room_times')->insert([
            [
                'meeting_room_id'   => 1,
                'day'               => 'Saturday',
                'time'              => '01:00',
                'price'             => '10',
            ],
            [
                'meeting_room_id'   => 1,
                'day'               => 'Saturday',
                'time'              => '02:00',
                'price'             => '10',
            ],
            [
                'meeting_room_id'   => 1,
                'day'               => 'Sunday',
                'time'              => '01:00',
                'price'             => '10',
            ],
            [
                'meeting_room_id'   => 1,
                'day'               => 'Sunday',
                'time'              => '02:00',
                'price'             => '10',
            ],
            [
                'meeting_room_id'   => 2,
                'day'               => 'Saturday',
                'time'              => '01:00',
                'price'             => '10',
            ],
            [
                'meeting_room_id'   => 2,
                'day'               => 'Saturday',
                'time'              => '02:00',
                'price'             => '10',
            ],
            [
                'meeting_room_id'   => 2,
                'day'               => 'Sunday',
                'time'              => '01:00',
                'price'             => '10',
            ],
            [
                'meeting_room_id'   => 2,
                'day'               => 'Sunday',
                'time'              => '02:00',
                'price'             => '10',
            ],            
            [
                'meeting_room_id'   => 3,
                'day'               => 'Saturday',
                'time'              => '01:00',
                'price'             => '10',
            ],
            [
                'meeting_room_id'   => 3,
                'day'               => 'Saturday',
                'time'              => '02:00',
                'price'             => '10',
            ],
            [
                'meeting_room_id'   => 3,
                'day'               => 'Sunday',
                'time'              => '01:00',
                'price'             => '10',
            ],
            [
                'meeting_room_id'   => 3,
                'day'               => 'Sunday',
                'time'              => '02:00',
                'price'             => '10',
            ],
        ]);


        // DB::table('meeting_room_options')->insert([
        //     [
        //         'meeting_room_id'   => 1,
        //         'option'            => json_encode(['en' => 'Assisstant to Welcome Your Clients '  , 'ar' => 'مساعد للترحيب بعملائك' ] , JSON_UNESCAPED_UNICODE),
        //     ],
        //     [
        //         'meeting_room_id'   => 1,
        //         'option'            => json_encode(['en' => 'Free Hospitality'  , 'ar' => 'الضيافة المجانية' ] , JSON_UNESCAPED_UNICODE),
        //     ],
        //     [
        //         'meeting_room_id'   => 1,
        //         'option'            => json_encode(['en' => 'Free Wifi '  , 'ar' => 'واى فاى مجانى' ] , JSON_UNESCAPED_UNICODE),
        //     ],
        //     [
        //         'meeting_room_id'   => 2,
        //         'option'            => json_encode(['en' => 'Assisstant to Welcome Your Clients '  , 'ar' => 'مساعد للترحيب بعملائك' ] , JSON_UNESCAPED_UNICODE),
        //     ],
        //     [
        //         'meeting_room_id'   => 2,
        //         'option'            => json_encode(['en' => 'Free Hospitality'  , 'ar' => 'الضيافة المجانية' ] , JSON_UNESCAPED_UNICODE),
        //     ],
        //     [
        //         'meeting_room_id'   => 2,
        //         'option'            => json_encode(['en' => 'Free Wifi '  , 'ar' => 'واى فاى مجانى' ] , JSON_UNESCAPED_UNICODE),
        //     ],
        //     [
        //         'meeting_room_id'   => 3,
        //         'option'            => json_encode(['en' => 'Assisstant to Welcome Your Clients '  , 'ar' => 'مساعد للترحيب بعملائك' ] , JSON_UNESCAPED_UNICODE),
        //     ],
        //     [
        //         'meeting_room_id'   => 3,
        //         'option'            => json_encode(['en' => 'Free Hospitality'  , 'ar' => 'الضيافة المجانية' ] , JSON_UNESCAPED_UNICODE),
        //     ],
        //     [
        //         'meeting_room_id'   => 3,
        //         'option'            => json_encode(['en' => 'Free Wifi '  , 'ar' => 'واى فاى مجانى' ] , JSON_UNESCAPED_UNICODE),
        //     ],
        // ]);
    }
}
