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

    public function get(string $langName) {
        return Lang::where([
            ['name', '=', $langName]
        ])->first();
    }
}
