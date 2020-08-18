<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HousePerspective extends Model
{
    protected $directory = '/house/';

    protected $fillable = ['path'];

    protected function getPathAttribute($photo){
        return $this->directory . $photo;
    }
}
