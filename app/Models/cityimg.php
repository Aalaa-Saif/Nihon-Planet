<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cityimg extends Model
{
    use HasFactory;

    protected $guarded =[]; //for mass assignments

    protected $table = "cityimgs";

    protected $fillable = [
        'city_id',
        'image',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [

    ];

    public function multiImgs()
    {
        return $this->belongsTo('App\Models\city');
    }
}

