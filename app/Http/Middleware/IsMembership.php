<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\UserMembership;

class IsMembership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $membership = UserMembership::where('users_id', auth()->user()->id)->firstOrFail();
        if (Auth::user() && $membership != null) {
            return $next($request);
        } else {
            Session::flash('error', 'Anda Harus Mendaftarkan Membership Terlebih Dahulu');
            return redirect()->back();
        }
    }
}
