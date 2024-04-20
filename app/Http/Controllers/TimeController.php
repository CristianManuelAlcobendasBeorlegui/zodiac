<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Time;
use Illuminate\Http\Request;

class TimeController extends Controller
{
    public function index() {
        return Time::all();
    }
}
