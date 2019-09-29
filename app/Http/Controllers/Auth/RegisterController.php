<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Snowfire\Beautymail\Beautymail;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Str;
use Mail;
use App\mail\verifyEmail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'phoneNo' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user=User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'username' => $data['username'],
            'country' => $data['country'],
            'city' => $data['city'],
            'phoneNo' => $data['phoneNo'],
            'confirmation_token' => Str::random(40),
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
         if (Cart::count() > 0) {
           $user->roles()->attach(Role::where('name','Customer')->first());
         }else {
           $user->roles()->attach(Role::where('name','User')->first());
         }
         //$thisUser=User::findOrFail($user->id);
         //$this->sendEmail($thisUser);
         return $user;
    }

    public function sendEmail($thisUser)
      {
        $beautymail = app()->make(Beautymail::class);
        $beautymail->send('emails.verify', ['user'=>$thisUser], function($message)
              {
                  $message->from('friendsofworship@gmail.com')
          			->to($thisUser->email, $thisUser->username)
          			->subject("Email Verification");
              });
      }

      public function verifyEmailFirst()
      {
        return view("emails.verifyEmailFirst");
      }

  public function sendEmailDone()
  {
    return "done";
  }
}
