<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function apikey()
    {
        $tokens = Auth::user()->tokens;
//        dd($tokens);

//        dd($tokens);
//        foreach ($tokens as $token) {
//            var_dump($token);
//        }
//        die();
        return view('apikey', compact('tokens'));
    }
}
