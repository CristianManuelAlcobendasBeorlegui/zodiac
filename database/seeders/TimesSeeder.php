<?php

namespace Database\Seeders;

use App\Models\Time;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrayTimes = ['today', 'yesterday', 'week', 'month'];
        foreach ($arrayTimes as $time) {
            Time::create([
                'name' => $time,
            ]);
        }
    }
}
