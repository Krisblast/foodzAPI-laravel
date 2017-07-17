<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = array('title', 'menu_items', 'user_id', 'restaurant_id');


    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
