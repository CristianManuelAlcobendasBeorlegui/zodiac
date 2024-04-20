<?php

namespace app\Interfaces;

interface ITranslator {
    public function translate(string $text, string $sourceIsoCode, string $targetIsoCode): string;
}