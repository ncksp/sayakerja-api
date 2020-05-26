<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    //
    protected $fillable = [
        'user_id','gender', 'address', 'resume', 'phone'
    ];

    protected $hidden = [
        'id','user_id','created_at', 'updated_at'
    ];
}
