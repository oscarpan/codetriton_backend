<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FBUser extends Model
{
    protected $guarded = [];

    protected $appends = ['guest_rating','host_rating'];

    public function guest_matches(){
        return $this->hasMany('App\Match', 'guest_id');
    }
    public function host_matches(){
        return $this->hasMany('App\Match', 'host_id');
    }

    public function getGuestRatingAttribute()
    {
        return $this->guest_matches()->avg('guest_rating');
    }

    public function getHostRatingAttribute()
    {
        return $this->host_matches()->avg('host_rating');
    }
}
