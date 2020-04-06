<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $guarded = [];

    //protected $fillable = ['title'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function galleries()
    {
        return $this->hasMany('App\Gallery');
    }
}
