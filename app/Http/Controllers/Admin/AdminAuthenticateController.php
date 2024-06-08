<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPasswordUpdateRequest;
use App\Http\Requests\HandleLoginRequest;
use App\Http\Requests\ResetLinkRequest;
use App\Mail\AdminPasswordResetLinkMail;
use App\Models\Admin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Pest\Support\Str;

class AdminAuthenticateController extends Controller
{
    public function login(){
        return view('admin.auth.login');
    }

    public function handleLogin(HandleLoginRequest $request){
        $request->authenticate();

        return redirect()->route('admin.dashboard')->with('success', __('Successfully logged in.'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }


    public function forgotPassword(){
        return view('admin.auth.forgot-password');
    }

    public function sendResetLink(ResetLinkRequest $request){

        $token = Str::random(64);
        $admin = Admin::where('email', $request->email)->first();
        $admin->remember_token = $token;
        $admin->save();

        Mail::to($request->email)->send(new AdminPasswordResetLinkMail($token, $request->email));

        return redirect()->back()->with('success', __('Password reset link sent! Check your email.'));
    }

    public function resetPassword($token, $email){
        return view('admin.auth.update-password',compact('token','email'));
    }


    public function updatePassword(AdminPasswordUpdateRequest $request){
         $admin = Admin::where(['email'=> $request->email, 'remember_token' => $request->token])->first();

         if (!$admin) {
            return back()->with('error', __('Token is invalid!'));
         }
         $admin->password = Hash::make($request->password);
         $admin->remember_token = null;
         $admin->save();

         return redirect()->route('admin.login')->with('success', __('Your Password reset successfull'));
    }

}
