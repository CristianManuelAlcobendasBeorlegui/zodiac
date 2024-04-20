<?php

namespace Database\Seeders;

use App\Models\Lang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LangsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $arrayIsoCodes = [
            'es' => 'spanish',
            'ca' => 'catalan',
            'en' => 'english',
        ];

        foreach ($arrayIsoCodes as $isoCode => $langName) {
            Lang::create([
                'iso_code' => $isoCode,
                'name' => $langName, 
            ]);
        }
    }
}
