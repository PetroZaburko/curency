<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LocaleController extends Controller
{
    public function show()
    {
        $languages = config('languages');
        return view('languages', compact('languages'));
    }

    public function guestSave($locale)
    {
        if (array_key_exists($locale, config('languages'))) {
            Session::put('locale', $locale);
        }
        return redirect()->back();
    }

    public function authSave(Request $request)
    {
        $locale =  $request->get('locale');
        Auth::user()->saveLocale($locale);
        Session::flash('success', __('main.lang_msg', [], $locale));
        return redirect()->back();
    }
}
