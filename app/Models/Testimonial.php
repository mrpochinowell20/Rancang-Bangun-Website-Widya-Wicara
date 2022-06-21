<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class Testimonial extends Authenticatable
{
    use Notifiable;

    public static function resolveId()
    {
        return Auth::check() ? Auth::testimonial()->getAuthIdentifier() : null;
    }

    protected $guarded = ['id'];

}
