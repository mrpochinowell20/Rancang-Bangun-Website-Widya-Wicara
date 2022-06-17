<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Comp extends Authenticatable
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
        return DB::table('compan')->where('id', $id)->first();
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'compan';
    protected $primarykey = 'id';
    protected $fillable = [
        'kebutuhan', 'keterangan',
    ];

}
