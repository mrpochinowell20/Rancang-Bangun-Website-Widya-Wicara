<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Companyy extends Authenticatable
{
    use Notifiable;
    // use Auditable;
    /**
     * {@inheritdoc}
     */
    public static function resolveId()
    {
        return Auth::check() ? Auth::company()->getAuthIdentifier() : null;

    }

    public function detailData($id)
    {
        return DB::table('company')->where('id', $id)->first();
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'company';
    protected $primarykey = 'id';
    protected $fillable = [
        'nama', 'content',
    ];

}
