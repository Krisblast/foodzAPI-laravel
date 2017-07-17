<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = array('name', 'type', 'lat', 'lng', 'user_id');

    public function menuItems()
    {
        return $this->hasMany('App\MenuItem');
    }

}
