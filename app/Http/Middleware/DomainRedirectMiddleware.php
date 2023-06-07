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
        // Get app domain from env.
        $prodDomain = env('PROD_DOMAIN');
        $mProdDomain = env('MPROD_DOMAIN');
        $uAppDomain = env('UAPP_DOMAIN');
        $uMAppDomain = env('UMAPP_DOMAIN');
        $aaDomain = env('AA_DOMAIN');
        $mAAppDomain = env('MAAPP_DOMAIN');

        // Get the current domain with http or https.
        $currentDomain = $request->getSchemeAndHttpHost();

        // Check if the user is on a mobile device.
        $isMobile = $this->isMobile();

        // Check if the user is authenticated.
        $isAuthenticated = Auth::check();

        /* Define the redirection logic based on the current domain, device, and authentication status. */

        if($isAuthenticated){

            /* ------------------------------ Authenticated ----------------------------- */

            $isAdmin = false; // test case.
            if($isAdmin){
                // Admin redirect.
                if ($isMobile && $currentDomain === $aaDomain) {
                    // Admin user website (desktop version) - Redirect to mobile version.
                    return redirect()->to($mAAppDomain . $request->getRequestUri());
                } elseif (!$isMobile && $currentDomain === $mAAppDomain) {
                    // Admin user website (mobile version) - Redirect to desktop version.
                    return redirect()->to($aaDomain . $request->getRequestUri());
                }
            }else{
                // User
                if ($isMobile && $currentDomain === $uAppDomain) {
                    // Authenticated user website (desktop version) - Redirect to mobile version.
                    return redirect()->to($uMAppDomain . $request->getRequestUri());
                } elseif (!$isMobile && $currentDomain === $uMAppDomain) {
                    // Authenticated user website (mobile version) - Redirect to desktop version.
                    return redirect()->to($uAppDomain . $request->getRequestUri());
                }elseif($currentDomain !==  $uAppDomain && $currentDomain !== $uMAppDomain){
                    // If the current domain is not app or m-app but the user is authenticated, use device for redirect
                    if($isMobile){
                        // Authenticated user website (desktop version) - Redirect to mobile version.
                        return redirect()->to($uMAppDomain . $request->getRequestUri());
                    }else{
                        // Authenticated user website (mobile version) - Redirect to desktop version.
                        return redirect()->to($uAppDomain . $request->getRequestUri());
                    }
                }
            }
        }else{

            /* ------------------------------------ Generic ----------------------------------- */

            if($isMobile && $currentDomain === $prodDomain){
                // Generic user website (desktop version) - Redirect to mobile version.
                return redirect()->to($mProdDomain . $request->getRequestUri());
            }elseif(!$isMobile && $currentDomain === $mProdDomain){
                // Generic user website (mobile version) - Redirect to desktop version.
                return redirect()->to($prodDomain . $request->getRequestUri());
            }elseif($currentDomain !== $prodDomain && $currentDomain !== $mProdDomain){
                // If the current domain is not prodDomain or mProdDomain and the user is not authenticated, use device for redirect.
                if($isMobile){
                     // Generic user website (desktop version) - Redirect to mobile version.
                    return redirect()->to($mProdDomain . $request->getRequestUri());
                }else{
                   // Generic user website (mobile version) - Redirect to desktop version.
                    return redirect()->to($prodDomain . $request->getRequestUri());
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
