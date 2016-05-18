<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\FBUser', 'f_b_user_id');
    }

    public function matches()
    {
        return $this->hasMany('App\Match');
    }
}
