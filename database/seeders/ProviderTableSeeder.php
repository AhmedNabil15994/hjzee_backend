<?php
namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class ProviderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('providers')->insert([
            [
                'name'              => 'Mohamed Ali' ,
                'phone'             =>'51111111', 
                'email'             => 'user1@gmail.com', 
                'password'          => bcrypt(123456),
                'type'              => 'service',
                'job'               => json_encode(['en' => 'Sr UI Designer'  , 'ar' => 'مصمم واجهات خبير'] , JSON_UNESCAPED_UNICODE),
                'info'              => json_encode(['en' => 'senior ui designer for more than 5 years and instructor for 3 years'  , 'ar' => 'مصمم واجهات لأكثر من 5 سنوات ومدرب لمدة 3 سنوات'] , JSON_UNESCAPED_UNICODE),
                'education_info'    => json_encode(['en' => 'He graduated from the College of Computers and Information, Class of 2020, and holds many awards and a diploma in professional design.'  , 'ar' => 'خريج كلية الحاسبات والمعلومات دفعه ٢٠٢٠ وحاصل علي العديد من الجوائز ودبلومه في التصميم الاحترافي'] , JSON_UNESCAPED_UNICODE),
            ],[
                'name'              => 'Ahmed Hassan', 
                'phone'             =>'51111112', 
                'email'             => 'user2@gmail.com', 
                'password'          => bcrypt(123456),
                'type'              => 'place',
                'job'               => json_encode(['en' => 'Sr Backend developer'  , 'ar' => 'مبرمج خبير'] , JSON_UNESCAPED_UNICODE) ,
                'info'              => json_encode(['en' => 'senior ui designer for more than 5 years and instructor for 3 years'  , 'ar' => 'مصمم واجهات لأكثر من 5 سنوات ومدرب لمدة 3 سنوات'] , JSON_UNESCAPED_UNICODE),
                'education_info'    => json_encode(['en' => 'He graduated from the College of Computers and Information, Class of 2020, and holds many awards and a diploma in professional design.'  , 'ar' => 'خريج كلية الحاسبات والمعلومات دفعه ٢٠٢٠ وحاصل علي العديد من الجوائز ودبلومه في التصميم الاحترافي'] , JSON_UNESCAPED_UNICODE),
            ]
        ]);
    }
}
