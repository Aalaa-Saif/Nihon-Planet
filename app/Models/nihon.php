<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nihon extends Model
{
    use HasFactory;

    protected $guarded =[]; //for mass assignments

    protected $table = "nihons";

    protected $fillable = [
        'name_ar',
        'name_en',
        'info_ar',
        'info_en',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [

    ];
}
