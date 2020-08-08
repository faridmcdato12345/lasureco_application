<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $guarded = [];
    public function photo(){
        return $this->belongsTo('App\Photo', 'photo_id');
    }
}
