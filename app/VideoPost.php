<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoPost extends Model
{
  protected $table='video_posts';

  public $primaryKey='id';

  public $timestamps=true;
}
