<?php

namespace App\Http\Controllers;

use App\Exports\RatesExport;
use App\Rate;
use App\Token;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

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
        return back()->with('error', __('main.api_regenerate') . $plainTextToken);
    }

    public function pdf(Rate $rate)
    {
        $rates = $rate->allLastUpdated();
        $date = $rates->max('created_at')->format('d-m-Y');
        $pdf = Pdf::loadView('pdf.currency', compact('rates', 'date'));
        return $pdf->download('currency_' . $date . '.pdf');
    }

    public function xlsx(Rate $rate)
    {
        return Excel::download(new RatesExport($rate), 'currency.xlsx');
    }
}
