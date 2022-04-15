<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\pacients;

class Availability
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
    $response = $next($request);

    if (pacients::find(session()->get('pacient_id'))){
      return $response;
    }
    flash('Пациент не найден!')->error();
    return redirect()->route('PacientsPage');
  }
}
