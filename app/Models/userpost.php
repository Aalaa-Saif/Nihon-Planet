<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userpost extends Model
{
    use HasFactory;

    //protected $guarded =[]; //for mass assignments

    protected $table = "userposts";

    protected $fillable = [
        'user_id',
        'text',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [

    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function userpostimgs(){
        return $this->hasMany('App\Models\userpostimg');
    }

    public function comments(){
        return $this->hasMany('App\Models\usercomment')->orderBy('created_at','ASC');
    }

}
