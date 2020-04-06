<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function ads()
    {
        return $this->hasMany('App\Ads');
    }
}
