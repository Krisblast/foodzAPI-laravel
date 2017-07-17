<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $fillable = array('name', 'type', 'price', 'image', 'restaurant_id', 'user_id');

    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant');
    }
}
