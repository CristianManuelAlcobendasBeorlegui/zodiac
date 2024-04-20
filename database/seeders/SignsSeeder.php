<?php

namespace Database\Seeders;

use App\Models\Sign;
use Illuminate\Database\Seeder;

class SignsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arraySigns = ['aquarius', 'pisces', 'aries', 'taurus', 'gemini', 'cancer', 'leo', 'virgo', 'libra', 'scorpio', 'sagittarius', 'carpicorn'];
        
        foreach ($arraySigns as $sign) {
            Sign::create([
                'name' => $sign,
            ]);
        }
    }
}
