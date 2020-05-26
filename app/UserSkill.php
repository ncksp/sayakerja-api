<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSkill extends Model
{
    //
    protected $fillable = [
        'user_id','skill'
    ];

    protected $hidden = [
        'id', 'user_id', 'created_at', 'updated_at'
    ];
}
