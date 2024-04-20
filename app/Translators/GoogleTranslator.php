<?php

namespace App\Translators;

use app\Interfaces\ITranslator;
use Stichoza\GoogleTranslate\GoogleTranslate;

class GoogleTranslator implements ITranslator {
    public function translate(string $text, string $sourceIsoCode, string $targetIsoCode): string {
        $googleTranslate = new GoogleTranslate('en');
        return $googleTranslate->setSource($sourceIsoCode)->setTarget($targetIsoCode)->translate($text);
    }
}