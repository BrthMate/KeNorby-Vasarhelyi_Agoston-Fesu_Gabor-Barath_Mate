<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\DB;
use Closure;
use Illuminate\Http\Request;

class MobilTokenCheck
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
        if($request->Sid==null ){
           return redirect('/error-page');
        }else{
            $data = DB::table('authentication')
            ->where("Token", $request->Sid)
            ->get();
            if(isset($data[0]->Token)){
                return $next($request);
            }
            else{
                return redirect('/error-page');
            }
        }
    }
}
