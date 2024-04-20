<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Lang;
use Illuminate\Http\Request;

class LangController extends Controller
{
    public function index() {
        return Lang::all();
    }

    public function getByName(string $name) {
        return Lang::where([
            ['name', '=', $name]
        ]);
    }

    public function existsIsoCode(string $isoCode): bool {
        return Lang::where([
            ['iso_code', '=', $isoCode]
        ])->exists();
    }
}
