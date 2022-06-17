<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Mediasosial extends Authenticatable
{
    use Notifiable;
    // use Auditable;
    /**
     * {@inheritdoc}
     */
    public static function resolveId()
    {
        return Auth::check() ? Auth::solution()->getAuthIdentifier() : null;

    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'mediasosial';
    protected $primarykey = 'id';
    protected $fillable = ['id', 'name', 'tipe', 'url', 'icon'];


}
