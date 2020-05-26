<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $fillable = [
        'user_id', 'name', 'address', 'contact'
    ];

    protected $hidden = [
        'user_id', 'updated_at', 'created_at'
    ];

    public function jobs()
    {
        return $this->hasMany('App\Job', 'company_id');
    }
}
