<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class city extends Model
{
    use HasFactory;

    protected $guarded =[]; //for mass assignments

    protected $table = "citys";

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

    public function images(){
        return $this->hasMany('App\Models\cityimg');
    }
}
