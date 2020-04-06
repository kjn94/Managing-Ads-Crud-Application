<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $guarded = [];

    //protected $fillable = ['filename'];

    public function ad()
    {
        return $this->belongTo('App/Gallery');
    }
}
