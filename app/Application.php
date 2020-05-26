<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    //
    protected $fillable = [
        'company_id', 'user_id', 'additional'
    ];

    protected $hidden = [
        'user_id','company_id','updated_at'
    ];

    public function company(){
        return $this->belongsTo('App\Company', 'company_id');
    }

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
