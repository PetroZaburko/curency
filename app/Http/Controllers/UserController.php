<?php

namespace App\Http\Controllers;

use App\Token;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function tokens()
    {
        $tokens = Auth::user()->tokens;
        return view('apikey', compact('tokens'));
    }

    public function regenerate($id)
    {
        /**
         * @var $token Token
         */;
        $token = Auth::user()->tokens->find($id);
        $plainTextToken = $token->regenerateCurrentToken();
        return back()->with('error', 'Your api token successful regenerated.  Please keep the token key in a safe place as it will not be shown again : ' . $plainTextToken);
    }
}
