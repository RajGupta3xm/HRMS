<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        // dd('inside');
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleCallback()
    {
        
            $user = Socialite::driver('google')->user();
            
            $existingUser = User::where('email', $user->email)->first();
    
            if ($existingUser) {
                $userDepartment = $existingUser->userDepartment;
    
                if ($userDepartment === 'Admin') {
                    return redirect('/dashboard');
                } elseif ($userDepartment === 'Delivery' || $userDepartment === 'Marketing' || $userDepartment === 'Business') {
                    auth()->login($existingUser);
                    return redirect('/user/dashboard');
                } else {
                    return redirect()->route('/login');
                }
            } else {
                return redirect()->route('unauthorized');
            }
         
    }
    

}
