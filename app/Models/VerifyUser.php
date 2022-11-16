<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VerifyUser extends Model
{
    use HasFactory;

    public $table = "verify_users";

    protected $fillable = [
        'user_id',
        'token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
