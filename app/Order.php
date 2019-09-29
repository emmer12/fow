<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function orderProduct()
    {
        return $this->hasMany('App\OrderProducts');
    }
    
}
