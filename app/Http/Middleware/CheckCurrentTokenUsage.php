<?php

namespace App\Http\Middleware;

use App\Token;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckCurrentTokenUsage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /** @var $currentToken Token
         */
        $currentToken = Auth::user()->currentAccessToken();
        if ($this->isNewMonthBecome()) {
            $currentToken->resetTokenUsage();
        }
        if ($currentToken->isTokenAllowed()) {
           $currentToken->increaseTokenUsage();
            return $next($request);
        }
        return response([
            'message' => 'The maximum allowed API amount of API requests has been reached'
        ], 200);
    }

    protected function isNewMonthBecome()
    {
        return Carbon::today()->format('d') == 1;
    }

}
