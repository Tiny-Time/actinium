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
        /* -----------------------  Get app domain from env. ---------------------- */

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

        // Get the current domain with http or https.
        $currentDomain = $request->getSchemeAndHttpHost();

        // Check if the user is on a mobile device.
        $isMobile = $this->isMobile();

        // Check if the user is authenticated.
        $isAuthenticated = Auth::check();

        // Request URI
        $uri = $request->getRequestUri();

        /* Define the redirection logic based on the current domain, device, and authentication status. */

        if($isAuthenticated){
            /* ------------------------------ Authenticated ----------------------------- */

            $isAdmin = auth()->user()->hasRole('super_admin');

            if($isAdmin){
                // Admin redirect.
                if ($isMobile) {
                    $needRedirect = $this->needRedirect($mAAppDomain, $currentDomain);
                    if(!$needRedirect){
                        // Admin user website (desktop version) - Redirect to mobile version.
                        return redirect()->to($mAAppDomain . $uri);
                    }
                } else {
                    $needRedirect = $this->needRedirect($aaDomain, $currentDomain);
                    if(!$needRedirect){
                        // Admin user website (mobile version) - Redirect to desktop version.
                        return redirect()->to($aaDomain . $uri);
                    }
                }
            }else{
                // User
                // Restrict admin access to users.
                if(str_contains($uri, '/admin')){
                    return abort(404);
                }

                if ($isMobile) {
                    $needRedirect = $this->needRedirect($uMAppDomain, $currentDomain);
                    if(!$needRedirect){
                        // Authenticated user website (desktop version) - Redirect to mobile version.
                        return redirect()->to($uMAppDomain . $uri);
                    }
                } else {
                    $needRedirect = $this->needRedirect($uAppDomain, $currentDomain);
                    if(!$needRedirect){
                        // Authenticated user website (mobile version) - Redirect to desktop version.
                        return redirect()->to($uAppDomain . $uri);
                    }
                }
            }
        }else{

            /* ------------------------------------ Generic ----------------------------------- */

            if($isMobile){
                $needRedirect = $this->needRedirect($mProdDomain, $currentDomain);
                if(!$needRedirect){
                    // Generic user website (desktop version) - Redirect to mobile version.
                    return redirect()->to($mProdDomain . $uri);
                }
            } else {
                $needRedirect = $this->needRedirect($prodDomain, $currentDomain);
                if(!$needRedirect){
                    // Generic user website (mobile version) - Redirect to desktop version.
                    return redirect()->to($prodDomain . $uri);
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

    public function needRedirect($domain, $currentDomain){
        return ($currentDomain === $domain);
    }
}
