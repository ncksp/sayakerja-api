<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //
    protected $fillable = [
        'company_id', 'user_id', 'name', 'position', 'salary', 'description'
    ];

    protected $hidden = [
        'company_id','user_id','updated_at'
    ];

    public function company(){
        return $this->belongsTo('App\Company','company_id');
    }

}
