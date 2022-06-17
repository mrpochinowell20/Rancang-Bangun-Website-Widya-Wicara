<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Solution extends Authenticatable
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

    public function detailData($id)
    {
        return DB::table('solution')->where('id', $id)->first();
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'solution';
    protected $fillable = [
        'nama', 'subtitle', 'deskriptions', 'icon', 
    ];

    public function features()
    {
        return $this->hasMany('Feature', 'solution');
    }
    
}