<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    public function episode()
    {
        return $this->belongsTo("App\PodcastEpic",'podcast_epic_id');
    }
}
