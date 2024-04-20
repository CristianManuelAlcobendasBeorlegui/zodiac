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
            'es' => 'Castellano',
            'ca' => 'Catalán',
            'en' => 'Inglés',
        ];

        foreach ($arrayIsoCodes as $isoCode => $langName) {
            Lang::create([
                'iso_code' => $isoCode,
                'name' => $langName, 
            ]);
        }
    }
}
