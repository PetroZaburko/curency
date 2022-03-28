<?php

namespace App\Http\Controllers;

use App\Rate;
use App\Token;
use Barryvdh\DomPDF\Facade\Pdf;
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

    public function pdf(Rate $rate)
    {
        $rates = $rate->allLastUpdated();
        $date = $rates->max('created_at')->format('d-m-Y');
        $pdf = Pdf::loadView('pdf.currency', compact('rates', 'date'));
        return $pdf->download('currency_' . $date . '.pdf');
    }
}
