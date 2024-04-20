<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Sign;
use Illuminate\Http\Request;

class SignController extends Controller
{
    public function index() {
        return Sign::all();
    }

    public function existsSign(string $name): bool {
        return Sign::where([
            ['name', '=', $name]
        ])->exists();
    }

    public function getByName(string $name) {
        return Sign::where([
            ['name', '=', $name]
        ]);
    }
}
