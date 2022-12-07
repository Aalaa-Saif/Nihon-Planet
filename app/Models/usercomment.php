<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usercomment extends Model
{
    use HasFactory;

    protected $guarded =[]; //for mass assignments

    protected $table = "usercomments";

    protected $fillable = [
        'user_id',
        'userpost_id',
        'comment',
        'created_at',
        'updated_at'
    ];

    protected $hidden = [

    ];

    public function user_comment(){
        return $this->belongsTo('App\Models\Userpost');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
