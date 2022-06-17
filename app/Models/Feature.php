<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Feature extends Authenticatable
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
        return DB::table('feature')->where('id', $id)->first();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'feature';
    protected $fillable = [
        'nama', 'subtitle', 'deskriptions', 'icon', 'action', 'solution_id'
    ];

    public function solution()
    {
        return $this->belongsTo('Solution', 'id');
    }
    
}