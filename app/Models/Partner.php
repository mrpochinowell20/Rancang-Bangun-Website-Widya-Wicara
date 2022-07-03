<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

<<<<<<<< HEAD:app/Models/Galeri.php
class Galeri extends Model
{
    use HasFactory;
    protected $table = 'galeri';
    protected $fillable = ['no','image', 'description'];
}
========
class Partner extends Model
{
    use HasFactory;
    protected $table='partner';
    protected $guarded = ['id'];
}
>>>>>>>> project-rika:app/Models/Partner.php
