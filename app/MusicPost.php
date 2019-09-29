<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MusicPost extends Model
{

  public function getWorshipper()
    {
        return Worshippers::where('id',$this->worshippers_id)->first();
    }
   public function user()
   {
       return $this->belongsTo("App\User");
   }
}
