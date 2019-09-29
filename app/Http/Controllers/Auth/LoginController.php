<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Role;
use Auth;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
     protected function redirectTo(){
        if(User::find(1)->hasRole("User") && Auth::user()){
          return '/dashboard';
        }
        elseif(User::find(1)->hasRole("Admin") && Auth::user()){
          return '/admin';
        }
        else {
          return '/dashboard';
        }
      }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
     protected function validator(array $data)
   {
         return Validator::make($data, [
             'email' => 'required|string|email|max:255|unique:users',
             'password' => 'required|string|min:6|confirmed',
         ]);
     }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');

    }

    public function ShowAdmin()
    {
      return view("admin/login")->with('url','admin');

    }

    public function customLogin(Request $request)
    {
      $this->validate($request,[
        'email'=>'required|email',
        'password'=>'required|min:6'
      ]);


      if (Auth::attempt([
           'email'=>$request->email,
           'password'=>$request->password
        ],true)) {
        if (User::find(1)->roleRedirect('Admin')) {
          return redirect()->route('admin.dashboard');
        }
        elseif(User::find(1)->roleRedirect('Customer')) {
          return redirect()->route('customer.dashboard');
        }
        else{
          if (Session::get("url_intended")) {
            return redirect(Session::get("url_intended"));
          }
          return redirect()->intended('/dashboard');
        }
      }
        Session::flash('msg','inverlid cridentials, please try again');
        return redirect()->back();
    }




protected function SendfailResponse(Request $request )
{
  $request->session()->put('login_error',trans('auth.failed'));
  throw ValidationException::withMessages([
    'error'=>[trans('auth.failed')],
  ]);
}

    public function LoginAdmin(Request $request )
    {
      $this->validate($request,[
        'email'=>'required|email',
        'password'=>'required|min:6'
      ]);
      if (Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password],$request->get('remember'))) {
        Auth::logout();
        return  redirect()->intended('/admin/dashboard');
      }
      return back()->withInput($request->only('email','remember'))->with(array(
        'msg'=>"Inavalid Cridential"
      ));
    }

}
