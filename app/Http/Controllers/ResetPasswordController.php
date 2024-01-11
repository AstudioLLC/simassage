<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\Rule;


class ResetPasswordController extends Controller
{
    use AuthenticatesUsers;


    public function showResetForm()
    {
        if (auth()->user()->role == 1){
            $user = auth()->user();
            return view('admin.auth.reset',compact('user'));
        }else{
            return redirect()->back();
        }
    }

    public function resetPassword(Request $request){


        $request->validate([
            // 'email' => 'required|email|exists:users',
            'old_password' => [
                'required',
                function ($attribute, $value, $fail) use ($request) {
                    // $user = User::where('email', $request->email)->first();
                    $user = auth()->user();

                    if (!Hash::check($value, $user->password)) {
                        $fail('Invalid Old Password!');
                    }
                }
            ],
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        // $user = User::where('email' , $request->email)->first();
        $user = auth()->user();


        if (Hash::check($request->old_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }else{
            return back()->withInput()->with('error', 'Invalid Old Password');
        }

        if(!$user){
            return back()->withInput()->with('error', 'Invalid Email!');
        }

        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();
        return redirect()->route('admin.login');

    }

    public function resetLogin(Request $request){

        $request->validate([
            'email' => 'required|email',
        ]);

        $user = auth()->user();

        $user->update([
            'email' => $request->email,
        ]);            

        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();
        return redirect()->route('admin.login');

    }
}
