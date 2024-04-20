<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horoscope extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'horoscope', 'sign_id', 'time_id', 'lang_iso_code', 'referenced_horoscope'];
}
