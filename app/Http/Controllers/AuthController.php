<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ForgetPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\HtmlString;

class AuthController extends Controller
{
    public function viewLogin()
    {
        return view('auth.login');
    }
        
    public function loginPost(Request $request)
    {
        $credetials = [
        'email' => $request->email,
        'password' => $request->password,
        ];
        if (Auth::attempt($credetials)) {
            return redirect('/home')->with('success', 'Login successfully');
        }
        return back()->with('error', 'Email or Password salah');
    }
    
    public function viewForget()
    {
        return view('auth.forget');
    }

    public function forgetPost(Request $request)
    {
        $count = User::where('email', '=', $request->email)->count();
        if($count > 0)
        {
            $rand = base64_encode(rand(1, 9999));
            $forgetPassword = ForgetPassword::create([
                'email' => $request->email,
                'forget_token' => $rand,
            ]);
            return $link = env('APP_URL') . 'changepassword/' . $rand;
        }
        else
        {
            return redirect()->back()->with('error', 'Email not found');
        }
    }
    
    public function viewChangePassword($id)
    {
        $data = ForgetPassword::where('forget_token', '=', $id)->first();

        if ($data) {
            $createdAt = $data->created_at;
            $expiresAt = $createdAt->addHours(24);
            $now = now();
        
            if ($now->lt($expiresAt)) {
                return view('auth.change_password');
            } else {
                return 'The given Link expired';
            }
        } else {
            return 'Invalid Link';
        }
    }

    public function changePasswordPost(Request $request, $token)
    {
        $request->validate([
            'password' => 'required|confirmed',
        ]);

        $data = ForgetPassword::where('forget_token', '=', $token)->first();
        $email = $data->email;
        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Invalid token.');
        }

        $user->password = $request->password;
        $user->save();

        return redirect()->route('login')->with('success', 'Password updated successfully. Please login with your new password.');
    }

}
