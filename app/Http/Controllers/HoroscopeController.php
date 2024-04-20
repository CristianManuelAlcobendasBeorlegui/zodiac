<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Horoscope;

class HoroscopeController extends Controller {
    public function importHoroscopes() {
        $signController = new SignController();
        $timeController = new TimeController();

        // Get all signs and times
        $arraySigns = $signController->index();
        $arrayTimes = $timeController->index();

        // Get current date
        $currentDate = date('d/m/Y');

        foreach ($arraySigns as $sign) {
            foreach ($arrayTimes as $time) {
                // Check if horoscope exists
                switch (strtolower($time->name)) {
                    case 'yesterday':
                    case 'today':
                        $existsHoroscope = Horoscope::where([
                            ['date', '=', $currentDate], 
                            ['sign_id', '=', $sign->id], 
                            ['time_id', '=', $time->id], 
                        ])->exists();
                        break;

                    case 'week':
                        $startWeekDate = date('d/m/Y', strtotime('last monday'));
                        $endWeekDate = date('d/m/Y', strtotime('next sunday'));

                        $existsHoroscope = Horoscope::where([
                            ['date', '>=', $startWeekDate],
                            ['date', '<=', $endWeekDate], 
                            ['sign_id', '=', $sign->id], 
                            ['time_id', '=', $time->id], 
                        ])->exists();
                        break;

                    case 'month':
                        // Get current month
                        $currentMonth = date('m');

                        $existsHoroscope = Horoscope::where([
                            ['date', 'LIKE', '%/' . $currentMonth . '/%'], 
                            ['sign_id', '=', $sign->id], 
                            ['time_id', '=', $time->id], 
                        ])->exists();
                        break;
                }

                if (isset($existsHoroscope) && !$existsHoroscope) {
                    // Get current horoscope
                    $horoscope = file_get_contents('https://www.astrology-zodiac-signs.com/api/call.php?time=' . $time->name . '&sign=' . $sign->name . '');

                    // Add horoscope to DB
                    Horoscope::create([
                        'date' => $currentDate, 
                        'horoscope' => $horoscope, 
                        'sign_id' => $sign->id, 
                        'time_id' => $time->id, 
                    ]);
                }
            }
        }
    }
}
