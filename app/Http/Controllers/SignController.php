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
}
