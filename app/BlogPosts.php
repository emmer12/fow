<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class BlogPosts extends Model
{
  protected $fillable = [
      'title','body', 'preview_image','type',
  ];

  public function author()
  {
      return User::where('id',$this->user_id)->first();
      // return $this->belongsTo("\App\User");
  }
  public function users()
  {
      return $this->belongsTo('App\User');
  }


}
