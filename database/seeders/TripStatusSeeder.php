<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TripStatusSeeder extends Seeder
{
    public function run()
    {
        $currentDate = Carbon::now();
        
        $tripStatus = [
            ['description' => 'Agendado', 'created_at' => $currentDate],
            ['description' => 'Em Percurso', 'created_at' => $currentDate],
            ['description' => 'Concluída', 'created_at' => $currentDate]
        ];

        DB::table('trip_status')->insert($tripStatus);
    }
}
