<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $guarded = [];
    
    public function photo(){
        return $this->belongsTo('App\Photo', 'photo_id');
    }
    public function house(){
        return $this->belongsTo('App\HousePerspective', 'house_id');
    }
    public function declines(){
        return $this->hasMany(Decline::class);
    }
    public function inspections(){
        return $this->hasMany(Inspection::class);
    }
    public function paids(){
        return $this->hasMany(Paid::class);
    }
}
