<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use App\Models\User;
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
        // Get the env domain.
        $domain = env('APP_DOMAIN');
        // Get the current domain.
        $currentDomain = $request->getHost();
        // Check if the user is on a mobile device.
        $isMobile = $this->isMobile();
        // Check if the user is authenticated.
        $isAuthenticated = Auth::check();

        // Define the redirection logic based on the current domain, device, and authentication status.
        if (!$isAuthenticated && $currentDomain === $domain && $isMobile) {
            // Generic user website (desktop version) - Redirect to mobile version.
            return redirect()->to('http://m.' . $domain . $request->getRequestUri());
        } elseif (!$isAuthenticated && $currentDomain === 'm.' . $domain && !$isMobile) {
            // Generic user website (mobile version) - Redirect to desktop version.
            return redirect()->to('http://' . $domain . $request->getRequestUri());
        } elseif ($isAuthenticated) {
            // User is authenticated and user role is admin
            $userRole = false; // for test case
            if($userRole){
                if ($currentDomain === 'admin.' . $domain && $isMobile) {
                    // Admin user website (desktop version) - Redirect to mobile version.
                    return redirect()->to('http://m-admin.' . $domain . $request->getRequestUri());
                } elseif ($currentDomain === 'm-admin.' . $domain && !$isMobile) {
                    // Admin user website (mobile version) - Redirect to desktop version.
                    return redirect()->to('http://admin.' . $domain . $request->getRequestUri());
                }
            }else{
                if ($currentDomain === 'app.' . $domain && $isMobile) {
                    // Authenticated user website (desktop version) - Redirect to mobile version.
                    return redirect()->to('http://m-app.' . $domain . $request->getRequestUri());
                } elseif ($currentDomain === 'm-app.' . $domain && !$isMobile) {
                    // Authenticated user website (mobile version) - Redirect to desktop version.
                    return redirect()->to('http://app.' . $domain . $request->getRequestUri());
                }elseif($currentDomain !== 'app.' . $domain && $currentDomain !== 'm-app.' . $domain){
                    // If the current domain is not app or m-app but the user is authenticated, use device for redirect
                    if($isMobile){
                        // Authenticated user website (desktop version) - Redirect to mobile version.
                        return redirect()->to('http://m-app.' . $domain . $request->getRequestUri());
                    }else{
                        // Authenticated user website (mobile version) - Redirect to desktop version.
                        return redirect()->to('http://app.' . $domain . $request->getRequestUri());
                    }
                }
            }
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

        return preg_match('/Android|BlackBerry|iPhone|iPad|iPod|Opera Mini|IEMobile/i', $userAgent);
    }
}
