<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function perfil($user){
        $user = User::find($user);
        return view('Doctor.perfil',compact('user'));
    }
}
