<?php
/**
 * Created by PhpStorm.
 * User: jkh
 * Date: 1/27/19
 * Time: 10:48 PM
 */

namespace Addgod\NovaCms\Http\Middleware;

use App\Nova\Page;
use Closure;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->method() === 'GET') {
            $locale = Page::$defaultLocale;
            $segment = $request->segment(1);
            if (in_array($segment, Page::$locales)) {
                $locale = $segment;
            }

            url()->defaults(['locale' => $locale]);
            session(['locale' => $locale]);
            app()->setLocale($locale);
        }

        return $next($request);
    }
}
