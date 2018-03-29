<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// app/Http/Middleware/Language.php

namespace App\Http\Middleware;
 
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
 
class Language
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
        
        if (Session::has('locale') AND in_array(Session::get('locale'), Config::get('app.languages'))) {
            App::setLocale(Session::get('locale'));
        }
        else { // This is optional as Laravel will automatically set the fallback language if there is none specified
            App::setLocale(Config::get('app.fallback_locale'));
        }
        
        return $next($request);
    }
}