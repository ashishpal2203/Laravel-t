<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function registerForm(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|date',
            'education' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $age = Carbon::parse($data['age'])->age;

        if ($age >= 18) {
            User::create([
                'name' => $data['name'],
                'age' => $data['age'],
                'education' => $data['education'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            $users = User::all();
            return view('dashboard',compact('users'));
        } else {
            return redirect()->away('https://www.google.com');
        }
    }
}
