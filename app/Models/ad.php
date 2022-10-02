<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ad extends Model
{
    use HasFactory;

    protected $guarded =[]; //for mass assignments

    protected $table = "ads";

    protected $fillable = [
        'text',
        'media',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [

    ];
}
