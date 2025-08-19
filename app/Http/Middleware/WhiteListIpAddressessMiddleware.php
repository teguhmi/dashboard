<?php

namespace App\Http\Middleware;

use App\Http\Controllers\SettingController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\IpUtils;
use function Symfony\Component\Translation\t;

class WhiteListIpAddressessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public $whitelistIps = [
        '10.44.10.0/24',
        '10.45.10.0/24',
        '10.42.10.0/24'
    ];

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */


    public function handle(Request $request, Closure $next)
    {
        $clientIp = SettingController::getIP();
        $whitelistIps = $this->whitelistIps;
        if (!IpUtils::checkIp($clientIp,$whitelistIps)) {
//        if (!in_array($clientIp, $this->whitelistIps)) {
            abort(403, "You are restricted to access the site.");
        }
        return $next($request);
    }
}
