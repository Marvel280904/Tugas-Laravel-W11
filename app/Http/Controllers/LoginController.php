<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function actionLogin(Request $request)
    {
        // Validate the form data
        $request->validate([
            "name" => 'required|min:4',
            "email" => 'required|email',
            "password" => 'required|min:8',
        ]);

        // Create a new user record
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->email_verified_at = now();
        $user->password = Hash::make($request->input('password'));
        $user->created_at = now();
        $user->updated_at = now(); 
        $user->save();

        // Redirect back with success message
        return redirect()->back()->with("success", "User registered successfully");
    }
}
