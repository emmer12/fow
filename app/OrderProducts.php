<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
class OrderProducts extends Model
{
  public function product()
  {
      return Product::where('id',$this->products_id)->get();
  }
}
