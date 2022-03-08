<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypeSeeder extends Seeder
{
    public function run()
    {
        $currentDate = Carbon::now(); 
        
        $userTypes = [
            ['type' => 'Cliente', 'created_at' => $currentDate],
            ['type' => 'Taxista', 'created_at' => $currentDate],
        ];

        DB::table('user_type')->insert($userTypes);
    }
}
