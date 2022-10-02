<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userpostimg extends Model
{
    use HasFactory;

    protected $guarded =[]; //for mass assignments

    protected $table = "userpostimgs";

    protected $fillable = [
        'userpost_id',
        'image',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [

    ];

    public function user_post(){
        return $this->belongsTo('App\Models\userpost');
    }
}
