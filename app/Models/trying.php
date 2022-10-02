<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class trying extends Model
{
    use HasFactory;

    protected $guarded =[]; //for mass assignments

    protected $table = "tryings";

    protected $fillable = [
        'userpost_id',
        'write',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [

    ];

    public function user_write(){
        return $this->belongsTo('App\Models\userpost');
    }

}
