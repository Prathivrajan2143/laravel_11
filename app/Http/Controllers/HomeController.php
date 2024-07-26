<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard()
    {   
        $user_count = User::all()->count();
        if($user_count > 0)
        {
            $users = User::all();
        }
        else
        {
            $users = 'No Data Found';
        }
        return view('pages.home', compact('users'));
    }
}
