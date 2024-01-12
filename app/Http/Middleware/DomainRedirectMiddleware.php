<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DomainRedirectMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    public function handle(Request $request, Closure $next): Response
    {
        // Main Domain
        $prodDomain = env('PROD_DOMAIN');
        // Mobile Main Domain
        $mProdDomain = env('MPROD_DOMAIN');
        // Auth Domain
        $uAppDomain = env('UAPP_DOMAIN');
        // Mobile Auth Domain
        $uMAppDomain = env('UMAPP_DOMAIN');
        // Admin Domain
        $aaDomain = env('AA_DOMAIN');
        // Mobile Admin Domain
        $mAAppDomain = env('MAAPP_DOMAIN');

        // Check if the user is on a mobile device.
        $isMobile = $this->isMobile();

        // Check if the user is authenticated.
        $isAuthenticated = Auth::check();

        // Request URI
        $uri = $request->getRequestUri();

        // Log users out on forgot password page
        if ($isAuthenticated && $request->is('forgot-password')) {
            Auth::logout();
        }

        // Define the redirection logic based on the current domain, device, and authentication status.

        if ($isAuthenticated && !$request->is('forgot-password')) {
            // Authenticated
            $isAdmin = $request->user()->hasRole('super_admin');

            if ($isAdmin) {
                // Admin redirect.
                $domain = $isMobile ? $mAAppDomain : $aaDomain;
            } else {
                // User
                $domain = $isMobile ? $uMAppDomain : $uAppDomain;

                // Restrict admin access to users.
                if (str_contains($uri, '/admin')) {
                    return abort(404);
                }
            }
        } else {
            // Generic
            $domain = $isMobile ? $mProdDomain : $prodDomain;
        }

        $needRedirect = $this->needRedirect($domain, $request->getSchemeAndHttpHost());

        if ($needRedirect) {
            return redirect()->to($domain . $uri);
        }

        return $next($request);
    }

    /**
     * isMobile
     *
     * @return bool
     */
    public function isMobile(): bool
    {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];

        return strpos($userAgent, 'Android') !== false
            || strpos($userAgent, 'BlackBerry') !== false
            || strpos($userAgent, 'iPhone') !== false
            || strpos($userAgent, 'iPad') !== false
            || strpos($userAgent, 'iPod') !== false
            || strpos($userAgent, 'Opera Mini') !== false
            || strpos($userAgent, 'IEMobile') !== false;
    }

    public function needRedirect($domain, $currentDomain)
    {
        return ($currentDomain != $domain);
    }
}
