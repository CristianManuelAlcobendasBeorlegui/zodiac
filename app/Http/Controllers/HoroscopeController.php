<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Horoscope;
use Stichoza\GoogleTranslate\GoogleTranslate;

class HoroscopeController extends Controller {
    public function importHoroscopes() {
        $signController = new SignController();
        $timeController = new TimeController();
        $langController = new LangController();

        // Get all signs and times
        $arraySigns = $signController->index();
        $arrayTimes = $timeController->index();

        // Get current date
        $currentDate = date('d/m/Y');

        // Get english ISO code 'id'
        $englishIsoCode = $langController->get('english')->iso_code;

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
                            ['lang_iso_code', '=', $englishIsoCode], 
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
                            ['lang_iso_code', '=', $englishIsoCode], 
                        ])->exists();
                        break;

                    case 'month':
                        // Get current month
                        $currentMonth = date('m');

                        $existsHoroscope = Horoscope::where([
                            ['date', 'LIKE', '%/' . $currentMonth . '/%'], 
                            ['sign_id', '=', $sign->id], 
                            ['time_id', '=', $time->id], 
                            ['lang_iso_code', '=', $englishIsoCode], 
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
                        'lang_iso_code' => $englishIsoCode,
                        'referenced_horoscope' => 0,
                    ]);
                }
            }
        }
    }

    public function addPendingTranslations() {
        $langController = new LangController();
        
        // Get english iso code
        $englishIsoCode = $langController->get('english')->iso_code;

        // Get all languages
        $arrayLanguages = $langController->index();

        // Get all english horoscopes 
        $arrayEnglishHoroscopes = Horoscope::where([
            ['lang_iso_code', '=', $englishIsoCode]
        ])->get();

        // Add pending horoscope language translation
        foreach ($arrayEnglishHoroscopes as $horoscope) {
            foreach ($arrayLanguages as $language) {
                if ($language->iso_code != $englishIsoCode) {
                    $existsHoroscopeTranslation = Horoscope::where([
                        ['lang_iso_code', '=', $language->iso_code], 
                        ['referenced_horoscope', '=', $horoscope->id],
                    ])->exists();

                    if (!$existsHoroscopeTranslation) {
                        Horoscope::create([
                            'date' => $horoscope->date, 
                            'horoscope' => null,
                            'sign_id' => $horoscope->sign_id,
                            'time_id' => $horoscope->time_id, 
                            'lang_iso_code' => $language->iso_code,
                            'referenced_horoscope' => $horoscope->id, 
                        ]);
                    }
                }
            }
        }
    }

    public function translate() {
        $langController = new LangController();

        // Get translator
        $translator = new GoogleTranslate();

        // Get english iso code
        $englishIsoCode = $langController->get('english');

        // Get first 15 pending translations
        $arrayPendingHoroscopeTranslations = Horoscope::whereNull('horoscope')
        ->take(15)
        ->get();

        // Translate and update horoscopes 
        foreach ($arrayPendingHoroscopeTranslations as $horoscope) {
            // Get referenced horoscope
            $referencedHoroscope = Horoscope::where([
                ['id', '=', $horoscope->referenced_horoscope]
            ])
            ->first();

            // Translate the text
            $translatedHoroscope = $translator->translate($referencedHoroscope->horoscope, 'en', $horoscope->lang_iso_code);
            
            // Update horoscope info
            Horoscope::where([
                ['id', $horoscope->id]
            ])
            ->update([
                'horoscope' => $translatedHoroscope, 
            ]);
        }
    }
}
