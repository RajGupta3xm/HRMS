<?php
 
namespace App\Http\Controllers\Admin\Auth;
 
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
 
class LoginController extends Controller
{
public function __construct(){
    $this->middleware('guest:admin')->except('logout');
}

/**
* Show the login form.
*
* @return \Illuminate\Http\Response
*/
public function showLoginForm()
{
   die('showlogingform');
return view('login'); //name of the admin login view
}
/**
* Login the admin.
*
* @param \Illuminate\Http\Request $request
* @return \Illuminate\Http\RedirectResponse
*/
public function login(Request $request)
{
    die('logincontrolleer');
    $credentials = $request->only('email', 'password');

    if (Auth::guard('admin')->attempt($credentials)) {
        return redirect('dashboard'); 
    }

    return redirect()->back()->with('error', 'Invalid credentials');
}
protected function guard(){
    return Auth::guard('admin');
}
/**
* Logout the admin.
* @return \Illuminate\Http\RedirectResponse
*/
public function logout($request)
   {
     //logout the admin…
     Auth::guard('admin')->logout();
 
   $request->session()->invalidate();
 
   $request->session()->regenerateToken();
   return $this->loggedOut($request) ?: redirect('/admin/login');  
}}
