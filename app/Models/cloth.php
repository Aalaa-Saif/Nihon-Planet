<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cloth extends Model
{
    use HasFactory;

    protected $table = "cloths";

    protected $fillable = [
        'name_ar',
        'name_en',
        'info_ar',
        'info_en',
        'photo',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [

    ];
}
