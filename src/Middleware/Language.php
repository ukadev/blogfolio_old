<?php

namespace Ukadev\Blogfolio\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use anlutro\LaravelSettings\Facade as Settings;

class Language
{

    var $languages = ['en', 'es'];

    public function handle($request, Closure $next)
    {
        if (Session::has('locale') AND array_key_exists(Session::get('locale'), $this->languages)) {
            App::setLocale(Session::get('locale'));
        }
        else
        {
            App::setLocale(Settings::get('siteLanguage'));
        }
        return $next($request);
    }
}