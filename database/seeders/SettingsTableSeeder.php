<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SettingsTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('settings')->delete();

        $data = [
            ['key' => 'current_session', 'value' => '2023-2024'],
            ['key' => 'school_title', 'value' => 'مد'],
            ['key' => 'school_name', 'value' => 'مدرسة السعيد ذي عنقب'],
            ['key' => 'directorate', 'value' => 'مديرية التربية والتعليم بذي عنقب'],
            ['key' => 'governorate', 'value' => 'محافظة ذي عنقب'],
            ['key' => 'center', 'value' => 'مركز ذي عنقب التعليمي'],
            ['key' => 'end_first_term', 'value' => '01-12-2023'],
            ['key' => 'end_second_term', 'value' => '01-05-2024'],
            ['key' => 'phone', 'value' => '0123456789'],
            ['key' => 'address', 'value' => 'ذي عنقب'],
            ['key' => 'school_email', 'value' => 'info@alsaeed.edu'],
            ['key' => 'logo', 'value' => 'logo-dark.png'],
        ];

        DB::table('settings')->insert($data);
    }
}
