<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worshippers extends Model
{
  public function audios()
  {
      return $this->hasMany('App\MusicPost');
  }
}
