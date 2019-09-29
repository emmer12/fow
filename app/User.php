<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    private $user;

    public function audios()
    {
        return $this->hasMany('App\MusicPost');
    }

    public function userBlogPost()
    {
        return $this->hasMany('App\BlogPosts');
    }

    public function userAudioPost()
    {
        return $this->hasMany('App\MusicPost');
    }


    public function userBookPost()
    {
        return $this->hasMany('App\Books');
    }

    public function roleRedirect($user)
    {
        return Auth::user()->roles()->where('name',$user)->first();
    }


    // public function getRole($id)
    // {
    //   return Auth::user()->roles()
    // }

    public function roles()
    {
        return $this->belongsToMany('App\Role','user_roles','user_id','role_id');
    }

    public function hasAnyRole($roles)
    {
      if (is_array($roles)) {
        foreach ($roles as $role) {
          if ($this->hasRole($role)) {
            return true;
          }
        }
      }
      else {
        if ($this->hasRole($roles)) {
          return true;
        }
      }
    }


  public function hasRole($role)
  {
    if ($this->roles()->where('name',$role)->first()){
      return true;
    }
    return false;
  }

  public function posts()
  {
      return $this->hasMany("App\BlogPosts");
  }

  public function access()
  {
      return $this->belongsToMany('App\Role','user_roles','user_id','role_id');
  }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname','country','lastname','username','phoneNo','email', 'password','confirmation_token','city'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
