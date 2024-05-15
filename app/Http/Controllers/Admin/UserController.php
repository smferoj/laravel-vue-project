<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function Index(){
        $users = User::latest()->get();
        
        return $users;
    }


    public function Store(Request $request) : User
    {
       return User::create([
        'name' => $request -> name,
        'email' => $request -> email,
        'password' => bcrypt($request -> password)

        ]);

        
    }
}
